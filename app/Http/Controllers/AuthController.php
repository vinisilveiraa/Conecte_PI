<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeUserMail;
use App\Models\Address;
use App\Models\Caregiver;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Helpers\StringHelper;
use App\Helpers\SlugHelper;

class AuthController extends Controller
{

    public function store(Request $request)
    {
        $request->merge([
            'rg' => StringHelper::onlyNumbers($request->rg),
            'telefone' => StringHelper::onlyNumbers($request->telefone),
            'cpf' => StringHelper::onlyNumbers($request->cpf)
        ]);

        // regras
        $rules = [
            'nome' => 'required|string',
            'cpf' => 'required|min:11',
            'rg' => 'required|min:9',
            'email' => 'required|email',
            'telefone' => 'required|min:9|max:14',
            'cep' => 'required|max:9',
            'logradouro' => 'required',
            'numero' => 'required|max:5',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required|size:2',
            'password' => 'required|confirmed|min:6|max:15',

            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric'
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
            'cep.max' => 'O campo cep pode conter no máximo 9 dígitos',
            'logradouro.required' => 'O campo logradouro é obrigatório',

            'numero.required' => 'O campo número é obrigatório',
            'numero.max' => 'Seu numero pode conter no máximo 5 dígitos',

            'bairro.required' => 'O campo bairro é obrigatório',
            'cidade.required' => 'O campo cidade é obrigatório',
            'estado.required' => 'O campo estado é obrigatório',
            'estado.size' => 'O campo estado deve conter exatamente :size caracteres',

            'coren.required_without' => 'O campo coren é obrigatório quando o certificado de cuidador não for preenchido',
            'certificado_cuidador.required_without' => 'O campo certificado de cuidador é obrigatório quando o coren não for preenchido',

            'password.required' => 'O campo senha é obrigatório',
            'password.confirmed' => "A senha e o confirmar senha dever ser exatamente iguais"
        ]);

        // verificar se este usuario ja existe por email e cpf
        if (User::where('email', $data['email'])->first()) {
            return redirect()->back()->with('error', 'E-mail já cadastrado!');
        }
        if (User::where('cpf', $data['cpf'])->first()) {
            return redirect()->back()->with('error', 'CPF já cadastrado!');
        }

        // normalizando os dados
        // este método esta declarado na class Controller
        $data['nome'] = $this->cleanInput($data['nome']);
        $data['cpf'] = $this->cleanInput($data['cpf']);
        $data['rg'] = $this->cleanInput($data['rg']);

        DB::beginTransaction();

        try {

            if (empty($data['latitude']) || empty($data['longitude'])) {

                $cidade = StringHelper::removeAccents($data['cidade']);
                $logradouro = StringHelper::removeAccents($data['logradouro']);
                $estado = $data['estado'];

                // Construa o endereço de forma mais robusta
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
                'numero' => $data['numero'],
                'bairro' => $data['bairro'],
                'cidade' => $data['cidade'],
                'estado' => $data['estado'],
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude']
            ]);

            // cria tipo de usuário
            if ($request->role === 'client') {
                Client::create([
                    'user_id' => $user->id
                ]);
            } else {

                $slug = SlugHelper::generateUnique($request->nome);

                do {
                    $publicCode = 'CON-' . strtoupper(Str::random(4));
                } while (Caregiver::where('public_code', $publicCode)->exists());


                Caregiver::create([
                    'user_id' => $user->id,
                    'slug' => $slug,
                    'public_code' => $publicCode,
                    'coren' => $data['coren'] ?? null,
                    'certificado_cuidador' => $data['certificado_cuidador'] ?? null,
                    'bio' => $data['bio'] ?? null,
                    'estrela' => 0,
                    'verificado' => false
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Erro ao cadastrar usuário');
        }


        // ENVIO DE E-MAIL
        // $link = route('login.link', $user->id);

        // Mail::to($user->email)->send(
        //     new WelcomeUserMail($user, $link)
        // );

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
        return redirect()->route('login')->with('error', 'E-mail ou senha incorretos!');
    }

    public function getCoordinates(Request $request)
    {
        $endereco = $request->endereco;

        $response = Http::withHeaders([
            'User-Agent' => 'ConecteApp/1.0 (seuemail@email.com)'
        ])->get('https://nominatim.openstreetmap.org/search', [
            'q' => $endereco,
            'format' => 'json'
        ]);

        return response()->json($response->json());
    }
}// fim da classe
