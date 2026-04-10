<?php

namespace App\Http\Controllers;

use App\Models\Caregiver;
use App\Models\User;
use App\Models\Proposal;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProposalController extends Controller
{
    // contrato
    // get
    public function hireForm($id)
    {
        // buscar cuidador
        $caregiver = Caregiver::with('user.address')->findOrFail($id);

        return view('client.dashboard-hire-form', compact('caregiver'));
    }

    // get
    public function hireHistory()
    {
        $client = Auth::user()->client;
        $status = request('status');

        $query = $client->proposals()->with('caregiver.user');

        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        $requests = $query->orderBy('created_at', 'desc')->get();

        return view('client.dashboard-hire-history', compact('requests'));
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

            'client_id' => $user->id,
            'caregiver_id' => $validated['caregiver_id'],

            'descricao_servico' => $validated['descricao_servico'],
            'endereco_servico' => $validated['endereco_servico'],

            // 'status' fica PENDING como DEFAULT
            // 'status' => pending,
        ]);

        return redirect()->route('client.hire-history')->with('success', 'Contratação solicitada com sucesso!');
    }
}
