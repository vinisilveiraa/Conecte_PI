<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeUserMail;
use App\Models\Address;
use App\Models\Caregiver;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function store(Request $request)
    {
        // regras
        $rules = [
            'nome' => 'required|string',
            'cpf' => 'required|min:11',
            'rg' => 'required|min:9',
            'email' => 'required|email',
            'telefone' => 'required|min:9|max:11',
            'cep' => 'required',
            'logradouro' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required|size:2',
            'password' => 'required|confirmed|min:6|max:15'
        ];
        // se o user for caregiver
        // validar estes campos a mais
        if ($request->role === 'caregiver') {
            $rules['coren'] = 'nullable|required_without:certificado_cuidador';
            $rules['certificado_cuidador'] = 'nullable|required_without:coren';
            $rules['bio'] = 'nullable|max:200';
        }
        // menssagens de erro
        $data = $request->validate($rules, [
            'nome.required' => 'O campo nome é obrigatório',
            'nome.string' => 'O nome deve conter apenas letras',

            'cpf.required' => 'O campo cpf é obrigatório',
            'cpf.min' => 'O cpf deve ter no minimo :min digitos',

            'rg.required' => 'O campo rg é obrigatório',
            'rg.min' => 'O rg deve ter no minimo :min digitos',

            'email.required' => 'O campo email é obrigatório',
            'email.email' => 'Digite um e-mail válido',

            'telefone.required' => 'O campo telefone é obrigatório',
            'telefone.min' => 'O telefone deve ter no minimo :min digitos',
            'telefone.max' => 'O telefone deve ter no maximo :max digitos',

            'cep.required' => 'O campo cep é obrigatório',
            'logradouro.required' => 'O campo logradouro é obrigatório',
            'bairro.required' => 'O campo bairro é obrigatório',
            'cidade.required' => 'O campo cidade é obrigatório',
            'estado.required' => 'O campo estado é obrigatório',
            'estado.size' => 'O campo estado deve conter exatamente :size caracteres',

            'password.required' => 'O campo senha é obrigatório',
            'password.confirmed' => "A senha e o confirmar senha dever ser exatamente iguais"
        ]);

        // verificar se este usuario ja existe por email e cpf
        $user = User::where('email', $data['email'])->where('cpf', $data['cpf'])->first();
        if ($user) {
            return redirect()->back()->with('error', 'Ja existe um usuario com esse email ou cpf !');
        }

        // normalizando os dados
        // este método esta declarado na class Controller
        $data['nome'] = $this->cleanInput($data['nome']);
        $data['cpf'] = $this->cleanInput($data['cpf']);
        $data['rg'] = $this->cleanInput($data['rg']);

        // cria usuário
        $user = User::create([
            'nome' => $data['nome'],
            'cpf' => $data['cpf'],
            'rg' => $data['rg'],
            'email' => $data['email'],
            'telefone' => $data['telefone'],
            'role' => $request->role,
            'password' => Hash::make($data['password']),
        ]);

        // cria endereço
        Address::create([
            'user_id' => $user->id,
            'cep' => $data['cep'],
            'logradouro' => $data['logradouro'],
            'bairro' => $data['bairro'],
            'cidade' => $data['cidade'],
            'estado' => $data['estado'],
            'latitude' => 0,
            'longitude' => 0
        ]);

        // cria tipo de usuário
        if ($request->role === 'client') {

            Client::create([
                'user_id' => $user->id
            ]);
        } else {

            Caregiver::create([
                'user_id' => $user->id,
                'coren' => $data['coren'] ?? null,
                'certificado_cuidador' => $data['certificado_cuidador'] ?? null,
                'bio' => $data['bio'] ?? null,
                'estrela' => 0,
                'verificado' => true
            ]);
        }

        // ====================================================================
        // ENVIO DE E-MAIL
        // ====================================================================
        $link = route('login.link', $user->id);

        Mail::to($user->email)->send(
            new WelcomeUserMail($user, $link)
        );

        return view('auth.check-email');
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            if ($user->role === 'client') {
                return redirect()->route('dashboard.client');
            } else {
                return redirect()->route('dashboard.caregiver');
            }
        }
        return redirect()->route('login')->with('error', 'Email ou senha incorretos !');
    }

}// fim da classe
