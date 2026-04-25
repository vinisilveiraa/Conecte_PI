<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Mockery\Generator\StringManipulation\Pass\Pass;

class PasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:users,email'
        ];
        $messages = [
            'email.required' => 'O campo de e-mail é obrigatório.',
            'email.email' => 'O campo de e-mail deve ser um endereço de e-mail válido.',
            'email.exists' => 'Não encontramos um usuário com esse e-mail.',
        ];

        $request->validate($rules, $messages);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function updatePassword(Request $request)
    {
        // valida
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        // tenta resetar a senha
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        // retorna a resposta
        return $status == Password::PASSWORD_RESET
            // "?" se a senha foi resetada, redireciona para o dashboard com uma mensagem de sucesso
            ? redirect()->route('login')->with('status', __($status))
            // ":" se houve um erro, redireciona de volta com uma mensagem de erro
            : back()->withErrors(['email' => [__($status)]]);
    }
}
