<?php

namespace Database\Seeders;

use App\Http\Controllers\ChatbotController;
use App\Models\ChatbotResposta;
use App\Models\ChatLog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChatbotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $respostas = [

            [
                'gatilhos' => ['contratar', 'cuidador', 'preciso de ajuda'],
                'resposta' => 'Você pode buscar cuidadores na página principal ou acessar: <a href="/buscar" target="_blank">Buscar cuidadores</a>'
            ],

            [
                'gatilhos' => ['cadastro', 'registrar', 'criar conta'],
                'resposta' => 'Clique aqui para se cadastrar: <a href="/cadastro-escolha">Cadastrar</a>'
            ],

            [
                'gatilhos' => ['sou cuidador', 'quero trabalhar', 'oferecer serviço'],
                'resposta' => 'Ótimo! Você pode se cadastrar como cuidador aqui: <a href="/cadastro-cuidador">Cadastro de cuidador</a>'
            ],

            [
                'gatilhos' => ['esqueci senha', 'recuperar senha'],
                'resposta' => 'Você pode redefinir sua senha aqui: <a href="/esqueci-senha">Recuperar senha</a>'
            ],

            [
                'gatilhos' => ['segurança', 'é confiável'],
                'resposta' => 'Sim! Todos os cuidadores passam por avaliação. Saiba mais em: <a href="/sobre-nos">Sobre nós</a>'
            ],

            [
                'gatilhos' => ['preço', 'valor', 'quanto custa'],
                'resposta' => 'Os valores variam conforme o cuidador e serviço. Você pode consultar direto na busca.'
            ],

            [
                'gatilhos' => ['contato', 'suporte', 'ajuda'],
                'resposta' => 'Fale com nossa equipe: <a href="/contato">Página de contato</a>'
            ],

            [
                'gatilhos' => ['tipos de cuidado', 'serviços'],
                'resposta' => 'Oferecemos cuidados para idosos, crianças e pós-operatório. Veja mais na página inicial.'
            ],

            [
                'gatilhos' => ['localização', 'cidade'],
                'resposta' => 'Você pode filtrar cuidadores por cidade na busca.'
            ],

            [
                'gatilhos' => ['oi', 'olá', 'bom dia', 'boa tarde', 'boa noite'],
                'resposta' => 'Olá! 👋 Posso te ajudar a encontrar um cuidador ou tirar dúvidas sobre a plataforma.'
            ]

        ];

        foreach ($respostas as $r) {
            ChatbotResposta::create($r);
        }
    }
}
