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

        // salva pra apaga dps
        $oldFoto = $user->foto;

        // pega arquivo
        $file = $request->file('avatar');
        // nomeia ele
        $filename = time() . '.' . $file->getClientOriginalExtension();
        // move ele
        $file->move(public_path('assets/imgs/caregivers'), $filename);

        // atualiza
        $user->foto = $filename;

        // apaga a antiga
        if ($oldFoto && file_exists(public_path('assets/imgs/caregivers/' . $oldFoto))) {
            unlink(public_path('assets/imgs/caregivers/' . $oldFoto));
        }

        $user->save();

        return back()->with('success', 'Avatar atualizado!');
    }
}
