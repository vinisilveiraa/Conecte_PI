<?php

namespace App\Http\Controllers;

use App\Models\Caregiver;
use App\Models\User;
use App\Models\Proposal;
use App\Models\Specialty;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProposalController extends Controller
{
    // contrato
    // get
    public function hireForm($id)
    {
        // buscar cuidador
        $caregiver = Caregiver::with(['user.address', 'reviews'])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->findOrFail($id);

        return view('client.dashboard-hire-form', compact('caregiver'));
    }

    // metodo para simplificar a busca de propostas, evitando repetição de código
    // $relation: 'client' ou 'caregiver' para definir a relação a ser carregada
    // $with: 'user' para carregar o usuário relacionado (cliente ou cuidador)
    // $status: status das propostas a serem filtradas (opcional)
    private function getProposal($relation, $with, $status)
    {
        // quando buscar proposals traga também o usuário relacionado (cliente ou cuidador)
        $query = $relation->with($with);

        // se tiver status, filtra por ele
        if (!$status || $status === 'all') {
            // mostrar tudo EXCETO canceladas e expiradas
            $query->whereNotIn('status', ['cancelled', 'expired']);
        } elseif ($status) {
            // filtrar normalmente
            $query->where('status', $status);
        }

        // retorna em ordem de criação, do mais recente para o mais antigo
        return $query->orderBy('created_at', 'desc')->get();
    }

    // metodo pra atualizar propostas quando cumpridas
    // roda quando alguem abre, melhor pra localmente ne
    private function autoUpdateProposals()
    {
        Proposal::where('status', 'accepted')
            ->where('data_fim', '<=', now())
            ->whereNull('completed_at')
            ->update([
                'status' => 'completed',
                'completed_at' => now()
            ]);

        Proposal::where('status', 'pending')
            ->where('data_inicio', '<=', now())
            ->whereNull('expired_at')
            ->update([
                'status' => 'expired',
                'expired_at' => now()
            ]);
    }

    // get
    // histórico de contratações do cliente (dashboard do cliente)
    public function hireHistory()
    {
        $this->autoUpdateProposals();

        $client = Auth::user()->client;
        $status = request('status');

        $requests = $this->getProposal(
            $client->proposals(),
            [
                'caregiver.user',
                'caregiver.reviews',
                'review'
            ],
            $status
        );

        // dd($requests);

        return view('client.dashboard-hire-history', compact('requests'));
    }

    // histórico de propostas do cuidador (dashboard do cuidador)
    public function proposalHistory()
    {
        $this->autoUpdateProposals();

        $caregiver = Auth::user()->caregiver;
        $status = request('status');

        $requests = $this->getProposal(
            $caregiver->proposals(),
            'client.user',
            $status
        );

        return view('caregiver.caregiver-proposals', compact('requests'));
    }




    // post
    public function hireCaregiver(Request $request)
    {
        // criar, checar e salvar contratacao
        // dd($request->all());

        $user = $request->user();

        $rules = [
            'caregiver_id' => 'required|exists:caregivers,id',
            'data_inicio' => 'required|date|after_or_equal:today',
            'data_fim' => 'required|date|after:data_inicio',
            'valor_servico' => 'required|numeric|min:0',
            'descricao_servico' => 'required|string|max:1000',
            'endereco_servico' => 'required|string|max:255',
        ];

        $messages = [
            'caregiver_id.exists' => 'O cuidador selecionado não existe',
            'data_inicio.required' => 'O campo data de início é obrigatório',
            'data_inicio.date' => 'O campo data de início deve ser uma data válida',
            'data_inicio.after_or_equal' => 'A data de início deve ser posterior à data de hoje',
            'data_fim.required' => 'O campo data de fim é obrigatório',
            'data_fim.date' => 'O campo data de fim deve ser uma data válida',
            'data_fim.after' => 'A data de fim deve ser posterior à data de início',
            'valor_servico.required' => 'O campo valor do serviço é obrigatório',
            'valor_servico.numeric' => 'O campo valor do serviço deve ser um número',
            'valor_servico.min' => 'O valor do serviço deve ser maior ou igual a zero',
            'descricao_servico.required' => 'O campo descrição do serviço é obrigatório',
            'descricao_servico.string' => 'O campo descrição do serviço deve ser uma string',
            'descricao_servico.max' => 'A descrição do serviço deve ter no máximo :max caracteres',
            'endereco_servico.required' => 'O campo endereço do serviço é obrigatório',
            'endereco_servico.string' => 'O campo endereço do serviço deve ser uma string',
            'endereco_servico.max' => 'O endereço do serviço deve ter no máximo :max caracteres',
        ];

        $validated = $request->validate($rules, $messages);

        Proposal::create([
            'valor_servico' => $validated['valor_servico'],
            'data_inicio' => $validated['data_inicio'],
            'data_fim' => $validated['data_fim'],

            'client_id' => $user->client->id,
            'caregiver_id' => $validated['caregiver_id'],

            'descricao_servico' => $validated['descricao_servico'],
            'endereco_servico' => $validated['endereco_servico'],

            // 'status' fica PENDING como DEFAULT
            // 'status' => pending,
        ]);

        return redirect()->route('client.hire-history')->with('success', 'Contratação solicitada com sucesso!');
    }

    public function setProposalStatus($id, $status)
    {
        $proposal = Proposal::findOrFail($id);
        $statusses = ['pending', 'accepted', 'rejected', 'cancelled', 'completed', 'expired'];

        if (!in_array($status, $statusses)) {
            return back()->with('error', 'Status inválido');
        }

        // autorização
        switch ($status) {
            case 'accepted':
            case 'rejected':
                // apenas o cuidador pode aceitar ou recusar
                if ($proposal->caregiver_id !== Auth::user()->caregiver->id) {
                    return back()->with('error', 'Ação não autorizada');
                }
                break;

            case 'cancelled':
                // apenas o cliente pode cancelar
                if ($proposal->client_id !== Auth::user()->client->id) {
                    return back()->with('error', 'Ação não autorizada');
                }
                break;
        }

        // atualizar status
        $proposal->status = $status;

        if ($status === 'accepted') {
            $proposal->accepted_at = now();
        }

        if ($status === 'completed') {
            $proposal->completed_at = now();
        }

        if ($status === 'cancelled') {
            $proposal->cancelled_at = now();
        }

        $proposal->save();

        return back()->with('success', "Status atualizado para {$status}");
    }

    public function rateCaregiver(Request $request)
    {
        // dd($request->all());
        $user = $request->user();

        $rules = [
            'proposal_id' => 'required|exists:proposals,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ];
        $messages = [
            'rating.required' => 'A avaliação é obrigatória',
            'rating.integer' => 'A avaliação deve ser um número inteiro',
            'rating.min' => 'A avaliação deve ser no mínimo :min estrela',
            'rating.max' => 'A avaliação deve ser no máximo :max estrelas',
            'comment.string' => 'O comentário deve ser uma string',
            'comment.max' => 'O comentário deve ter no máximo :max caracteres',
        ];

        $validated = $request->validate($rules, $messages);

        // pega a proposta, garantindo que ela exista, que pertença ao cliente e que esteja concluída
        $proposal = Proposal::where('id', $validated['proposal_id'])
            ->where('client_id', $user->client->id)
            ->where('status', 'completed')
            ->firstOrFail();

        if ($proposal->review) {
            return back()->with('error', 'Esta proposta já foi avaliada');
        }

        Review::create([
            'proposal_id' => $proposal->id,
            'caregiver_id' => $proposal->caregiver_id,
            'client_id' => $proposal->client_id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? '',

            // n sei se vai ser implementado
            // 'revisor_id' => null,
            // 'revisado_id' => null,
        ]);

        return back()->with('success', 'Cuidador avaliado com sucesso!');
    }
}
