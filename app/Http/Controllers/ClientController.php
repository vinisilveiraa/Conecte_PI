<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function selectSpecialty()
    {

        // CARREGAR ESPECIALIDADES
        $specialties = Specialty::all();

        return view('client.select-specialty', compact('specialties'));
    }

    public function loadCaregivers(Request $request)
    {
        // RECEBE O ID DA ESPECIALIDADE ESCOLHIDA
        $cuidados_pessoais = $request->cuidados_pessoais;

        // BUSCAR CUIDADORES QUE TEM ESTA ESPECIALIDADE CADASTRADA


        // RETORNAR OS CUIDADORES ENCONTRADOS PARA PAGINA select-specialty

        dd($cuidados_pessoais);
    }
}
