<?php

namespace Database\Seeders;

use App\Models\ChatbotResposta;
use Illuminate\Database\Seeder;

class ChatbotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $respostas = [

            // SAUDAÇÃO
            [
                'intent' => 'saudacao',

                'gatilhos' => [
                    'oi',
                    'ola',
                    'bom dia',
                    'boa tarde',
                    'boa noite',
                    'e ai',
                    'opa',
                    'hello'
                ],

                'resposta' => '
                    Olá! 👋<br><br>

                    Bem-vindo ao Conecte 😊<br><br>

                    Como posso ajudar você hoje?<br><br>

                    <div class="chatbot-buttons">

                        <button onclick="enviarMensagemBotao(\'quero contratar\')">
                            Buscar cuidador
                        </button>

                        <button onclick="enviarMensagemBotao(\'quero trabalhar\')">
                            Quero trabalhar
                        </button>

                        <button onclick="enviarMensagemBotao(\'sobre o conecte\')">
                            Sobre o Conecte
                        </button>

                        <button onclick="enviarMensagemBotao(\'suporte\')">
                            Suporte
                        </button>

                    </div>
                '
            ],

            // SOBRE O CONECTE
            [
                'intent' => 'sobre_conecte',

                'gatilhos' => [
                    'sobre o conecte',
                    'o que e o conecte',
                    'como funciona',
                    'sobre voces',
                    'quem sao voces',
                    'empresa',
                    'plataforma',
                    'como funciona o conecte'
                ],

                'resposta' => '
                    O Conecte é uma plataforma que aproxima cuidadores e pessoas que precisam de cuidados 😊<br><br>

                    Nosso objetivo é facilitar a busca por profissionais de forma simples, segura e acessível.<br><br>

                    Você pode encontrar cuidadores para:<br><br>

                    • Idosos<br>
                    • Crianças<br>
                    • Pós-operatório<br>
                    • Acompanhamento diário<br><br>

                    Saiba mais sobre a plataforma:<br><br>

                    <a href="' . route('sobre-nos') . '">
                        Sobre nós
                    </a><br><br>

                    <div class="chatbot-buttons">

                        <button onclick="enviarMensagemBotao(\'buscar cuidador\')">
                            Buscar cuidador
                        </button>

                        <button onclick="enviarMensagemBotao(\'quero trabalhar\')">
                            Quero trabalhar
                        </button>

                    </div>
                '
            ],

            // CONTRATAÇÃO
            [
                'intent' => 'contratacao',

                'gatilhos' => [
                    'contratar',
                    'contratar cuidador',
                    'preciso de cuidador',
                    'preciso de ajuda',
                    'buscar cuidador',
                    'cuidadora',
                    'cuidador para idoso',
                    'quero contratar'
                ],

                'resposta' => '
                    Você pode buscar cuidadores na plataforma clicando abaixo:<br><br>

                    <a href="' . route('client.searchCaregiver') . '">
                        Ir à Busca
                    </a><br><br>

                    <div class="chatbot-buttons">

                        <button onclick="enviarMensagemBotao(\'tipos de cuidado\')">
                            Tipos de cuidado
                        </button>

                        <button onclick="enviarMensagemBotao(\'preco\')">
                            Valores
                        </button>

                    </div>
                '
            ],

            // CADASTRO
            [
                'intent' => 'cadastro',

                'gatilhos' => [
                    'cadastro',
                    'registrar',
                    'criar conta',
                    'abrir conta',
                    'fazer cadastro',
                    'me cadastrar'
                ],

                'resposta' => '
                    Você pode criar sua conta aqui:<br><br>

                    <a href="' . route('register') . '">
                        Fazer cadastro
                    </a><br><br>

                    <div class="chatbot-buttons">

                        <button onclick="enviarMensagemBotao(\'quero trabalhar\')">
                            Cadastro cuidador
                        </button>

                    </div>
                '
            ],

            // CUIDADOR
            [
                'intent' => 'trabalhar',

                'gatilhos' => [
                    'sou cuidador',
                    'quero trabalhar',
                    'oferecer servico',
                    'trabalhar como cuidador',
                    'cadastrar como cuidador',
                    'prestar cuidados'
                ],

                'resposta' => '
                    Que bom ter você com a gente 😊<br><br>

                    Faça seu cadastro como cuidador:<br><br>

                    <a href="' . route('register.caregiver') . '">
                        Cadastro de cuidador
                    </a><br><br>

                    <div class="chatbot-buttons">

                        <button onclick="enviarMensagemBotao(\'como funciona\')">
                            Sobre o Conecte
                        </button>

                    </div>
                '
            ],

            // SENHA
            [
                'intent' => 'senha',

                'gatilhos' => [
                    'esqueci senha',
                    'recuperar senha',
                    'nao consigo entrar',
                    'perdi minha senha',
                    'resetar senha'
                ],

                'resposta' => '
                    Você pode redefinir sua senha aqui:<br><br>

                    <a href="' . route('password.request') . '">
                        Recuperar Minha Senha
                    </a>
                '
            ],

            // SEGURANÇA
            [
                'intent' => 'seguranca',

                'gatilhos' => [
                    'seguranca',
                    'e confiavel',
                    'confiavel',
                    'site seguro',
                    'golpe',
                    'posso confiar'
                ],

                'resposta' => '
                    Sim 😊<br><br>

                    Os cuidadores podem possuir avaliações, certificados e informações verificadas.<br><br>

                    Saiba mais aqui:<br><br>

                    <a href="' . route('sobre-nos') . '">
                        Sobre nós
                    </a>
                '
            ],

            // PREÇO
            [
                'intent' => 'preco',

                'gatilhos' => [
                    'preco',
                    'valor',
                    'quanto custa',
                    'precos',
                    'quanto e',
                    'custo'
                ],

                'resposta' => '
                    Os valores variam conforme o cuidador e o tipo de atendimento.<br><br>

                    Você pode consultar diretamente na busca de cuidadores 😊
                '
            ],

            // SUPORTE
            [
                'intent' => 'suporte',

                'gatilhos' => [
                    'contato',
                    'suporte',
                    'ajuda',
                    'falar com atendente',
                    'atendimento',
                    'preciso de suporte'
                ],

                'resposta' => '
                    Nossa equipe pode ajudar você 😊<br><br>

                    Entre em contato aqui:<br><br>

                    <a href="' . route('contatos') . '">
                        Página de contato
                    </a>
                '
            ],

            // SERVIÇOS
            [
                'intent' => 'servicos',

                'gatilhos' => [
                    'tipos de cuidado',
                    'servicos',
                    'o que voces oferecem',
                    'atendimentos',
                    'tipos de servico'
                ],

                'resposta' => '
                    Oferecemos cuidados para:<br><br>

                    • Idosos<br>
                    • Crianças<br>
                    • Pós-operatório<br>
                    • Acompanhamento diário<br><br>

                    <div class="chatbot-buttons">

                        <button onclick="enviarMensagemBotao(\'buscar cuidador\')">
                            Ir a Busca
                        </button>

                    </div>
                '
            ],

            // LOCALIZAÇÃO
            [
                'intent' => 'localizacao',

                'gatilhos' => [
                    'localizacao',
                    'cidade',
                    'perto de mim',
                    'na minha cidade',
                    'em jau',
                    'regiao'
                ],

                'resposta' => '
                    Você pode filtrar cuidadores por cidade diretamente na busca 😊<br><br>

                    <a href="' . route('client.searchCaregiver') . '">
                        Abrir busca
                    </a>
                '
            ],
        ];

        foreach ($respostas as $resposta) {

            ChatbotResposta::updateOrCreate(
                [
                    'intent' => $resposta['intent']
                ],
                $resposta
            );
        }
    }
}
