<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    //

    public function updateProfile(Request $request)
    {
        // dd($request->all());

        $user = $request->user();

        $rules = [
            'nome' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'email' => 'nullable|email|unique:users,email,' . Auth::id(),
            'telefone' => 'nullable|string|max:11',
            'cep' => 'nullable|string|max:10',
            'logradouro' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
        ];

        if ($user->role === 'caregiver') {
            $rules['coren'] = 'nullable|string|max:50';
            $rules['certificado_cuidador'] = 'nullable|file|mimes:jpg,png,pdf|max:2048';
            $rules['bio'] = 'nullable|string|max:1000';
        }

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

        $request->validate($rules, $messages);

        // USER
        $user->nome = $request->nome;
        if ($request->filled('email')) {
            $user->email = $request->email;
        }
        $user->telefone = $request->telefone;
        $user->save();

        // ADDRESS
        if ($user->address) {
            $user->address->cep = $request->cep;
            $user->address->logradouro = $request->logradouro;
            $user->address->bairro = $request->bairro;
            $user->address->cidade = $request->cidade;
            $user->address->save();
        }

        // CAREGIVER
        if ($user->role === 'caregiver') {

            $caregiver = $user->caregiver;

            $caregiver->coren = $request->coren;
            $caregiver->bio = $request->bio;



            // CERTIFICADO
            if ($request->hasFile('certificado_cuidador')) {

                // apaga antigo
                if ($caregiver->certificado_cuidador) {
                    Storage::disk('public')->delete($caregiver->certificado_cuidador);
                }

                $caminho = $request->file('certificado_cuidador')->store('certificados', 'public');

                $caregiver->certificado_cuidador = $caminho;
            }

            $caregiver->save();
        }


        if ($request->hasFile('foto')) {
            $this->handleAvatarUpload($request, $user);
        }

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

        $path = $user->role == 'caregiver'
            ? 'storage/caregivers/'
            : 'storage/clients/';

        if (!file_exists(public_path($path))) {
            mkdir(public_path($path), 0777, true);
        }

        $file->move(public_path($path), $filename);

        if ($oldFoto && file_exists(public_path($path . $oldFoto))) {
            unlink(public_path($path . $oldFoto));
        }

        $user->foto = $filename;
        $user->save();
    }
}
