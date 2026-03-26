<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //

    public function updateAvatar(Request $request)
    {
        // dd($request->all());
        // dd(\auth()->user());

        // precisa ter arquivo, ser imagem, formatos aceitos e no maximo 2mb
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // pega o user
        $user = request()->user();

        // dd([
        //     'user' => $user->id,
        //     'role' => $user->role,
        //     'file' => $request->file('avatar')
        // ]);

        // salva pra apaga dps
        $oldFoto = $user->foto;

        // pega arquivo
        $file = $request->file('avatar');

        // nomeia ele
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();

        // define o caminho com base na role
        $path = $user->role == 'caregiver'
            ? 'assets/imgs/caregivers/'
            : 'assets/imgs/clients/';

        if (!file_exists(public_path($path))) {
            mkdir(public_path($path), 0777, true);
        }

        // move o arquivo
        $file->move(public_path($path), $filename);

        // apaga a antiga
        if ($oldFoto && file_exists(public_path($path . $oldFoto))) {
            unlink(public_path($path . $oldFoto));
        }

        // atualiza
        $user->foto = $filename;
        $user->save();

        return back()->with('success', 'Avatar atualizado!');
    }
}
