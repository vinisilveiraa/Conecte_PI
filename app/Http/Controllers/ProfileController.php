<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Helpers\StringHelper;


class ProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        $request->merge([
            'telefone' => StringHelper::onlyNumbers($request->telefone),
        ]);

        $user = $request->user();

        $rules = [
            'nome' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'email' => 'nullable|email|unique:users,email,' . Auth::id(),
            'telefone' => 'nullable|string|max:11',
            'cep' => 'nullable|string|max:10',
            'logradouro' => 'nullable|string|max:255',
            'numero' => 'nullable|max:5',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'estado' => 'required|size:2',

            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric'
        ];

        $messages = [
            'email.email' => 'Digite um e-mail válido',
            'email.unique' => 'Este e-mail já está em uso',

            'foto.image' => 'O arquivo deve ser uma imagem',
            'foto.mimes' => 'A imagem deve ser do tipo jpg, jpeg ou png',
            'foto.max' => 'A imagem deve ter no máximo :max KB',

            'nome.string' => 'O nome deve conter apenas letras',
            'nome.max' => 'O nome deve ter no máximo :max caracteres',

            'telefone.string' => 'O telefone deve conter apenas números',
            'telefone.max' => 'O telefone deve ter no máximo :max caracteres',

            'cep.string' => 'O CEP deve conter apenas números',
            'cep.max' => 'O CEP deve ter no máximo :max caracteres',

            'bio.max' => 'O campo Bio deve ter no máximo :max caracteres',

            'certificado_cuidador.file' => 'O certificado deve ser um arquivo',
            'certificado_cuidador.mimes' => 'O certificado deve ser um arquivo de imagem (jpg, png) ou PDF',
            'certificado_cuidador.max' => 'O certificado deve ter no máximo : max KB',
        ];

        $data = $request->validate($rules, $messages);

        // USER
        $user->nome = $request->nome;
        if ($request->filled('email')) {
            $user->email = $request->email;
        }
        if ($request->filled('telefone')) {
            $user->telefone = $request->telefone;
        }
        $user->save();


        // fallback se n der certo com o JS
        if (empty($data['latitude']) || empty($data['longitude'])) {

            $cidade = StringHelper::removeAccents($data['cidade']);
            $logradouro = StringHelper::removeAccents($data['logradouro']);
            $estado = $data['estado'];

            $fullAddress = "{$logradouro}, {$cidade}, {$estado}, Brasil";

            $response = Http::withHeaders([
                'User-Agent' => 'ConecteApp/1.0'
            ])->get('https://nominatim.openstreetmap.org/search', [
                'q' => $fullAddress,
                'format' => 'json',
                'limit' => 1,
                'countrycodes' => 'br'
            ]);

            $geo = $response->json();

            if (!empty($geo) && isset($geo[0]['lat']) && isset($geo[0]['lon'])) {
                $data['latitude'] = (float) $geo[0]['lat'];
                $data['longitude'] = (float) $geo[0]['lon'];
            } else {
                $data['latitude'] = 0;
                $data['longitude'] = 0;
            }
        }

        // ADDRESS
        if ($user->address) {
            if ($request->filled('cep')) {
                $user->address->cep = $request->cep;
            }
            if ($request->filled('logradouro')) {
                $user->address->logradouro = $request->logradouro;
            }
            if ($request->filled('bairro')) {
                $user->address->bairro = $request->bairro;
            }
            if ($request->filled('cidade')) {
                $user->address->cidade = $request->cidade;
            }
            $user->address->numero = $request->numero;
            $user->address->latitude = $request->latitude;
            $user->address->longitude = $request->longitude;
            $user->address->save();
        }

        if ($request->hasFile('foto')) {
            $this->handleAvatarUpload($request, $user);
        }

        // return redirect()->route('dashboard.client')->with('success', 'Perfil atualizado com sucesso!');
        return redirect()->back()->with('success', 'Perfil atualizado com sucesso!');
    }



    public function updateAvatar(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'foto.required' => 'O avatar é obrigatório',
            'foto.image' => 'O arquivo deve ser uma imagem',
            'foto.mimes' => 'A imagem deve ser do tipo jpg, jpeg ou png',
            'foto.max' => 'A imagem deve ter no máximo :max KB',
        ]);

        $this->handleAvatarUpload($request, $user);
        return back()->with('success', 'Avatar atualizado!');
    }



    private function handleAvatarUpload($request, $user)
    {
        if (!$request->hasFile('foto')) return;

        $oldFoto = $user->foto;

        $file = $request->file('foto');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();

        $folder = $user->role == 'caregiver'
            ? 'caregivers'
            : 'clients';

        // salva corretamente no storage
        $file->storeAs($folder, $filename, 'public');

        // remove antigo
        if ($oldFoto) {
            Storage::disk('public')->delete($folder . '/' . $oldFoto);
        }

        $user->foto = $filename;
        $user->save();
    }
}
