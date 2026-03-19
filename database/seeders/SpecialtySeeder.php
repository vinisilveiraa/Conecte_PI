<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $specialties = [
            // CUIDADOS PESSOAIS
            [
                'nome' => 'Higiene Pessoal',
                'descricao' => 'Auxílio em banho, troca de roupas e cuidados básicos de higiene.',
                'categoria' => 'Cuidados Pessoais'
            ],
            [
                'nome' => 'Alimentação Assistida',
                'descricao' => 'Ajuda na alimentação de pacientes com dificuldades motoras ou de deglutição.',
                'categoria' => 'Cuidados Pessoais'
            ],

            // SAÚDE
            [
                'nome' => 'Administração de Medicamentos',
                'descricao' => 'Controle e administração correta de medicamentos conforme prescrição médica.',
                'categoria' => 'Saúde'
            ],
            [
                'nome' => 'Primeiros Socorros',
                'descricao' => 'Atendimento inicial em situações de emergência.',
                'categoria' => 'Saúde'
            ],
            [
                'nome' => 'Fisioterapia Básica',
                'descricao' => 'Exercícios simples para manutenção da mobilidade e recuperação física.',
                'categoria' => 'Saúde'
            ],

            // ACOMPANHAMENTO
            [
                'nome' => 'Acompanhamento Hospitalar',
                'descricao' => 'Acompanhamento do paciente durante internações e consultas médicas.',
                'categoria' => 'Acompanhamento'
            ],
            [
                'nome' => 'Cuidados com Idosos',
                'descricao' => 'Assistência diária para idosos, incluindo companhia e suporte geral.',
                'categoria' => 'Acompanhamento'
            ],

            //  ESPECIALIZADOS
            [
                'nome' => 'Cuidados com Alzheimer',
                'descricao' => 'Assistência especializada para pacientes com Alzheimer e demências.',
                'categoria' => 'Especializados'
            ],
            [
                'nome' => 'Cuidados Paliativos',
                'descricao' => 'Assistência focada no conforto e qualidade de vida.',
                'categoria' => 'Especializados'
            ],
            [
                'nome' => 'Cuidados com Mobilidade Reduzida',
                'descricao' => 'Auxílio na locomoção e prevenção de quedas.',
                'categoria' => 'Especializados'
            ],
        ];

        DB::table('specialties')->insert($specialties);
    }
}
