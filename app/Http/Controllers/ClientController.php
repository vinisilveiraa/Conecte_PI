<?php

namespace App\Http\Controllers;

use App\Models\Caregiver;
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
        $specialtyId =
            $request->cuidados_pessoais ??
            $request->saude ??
            $request->acompanhamento ??
            $request->cuidados_especializado;

        if (empty($specialtyId)) {
            return redirect()->route('select.specialty')->with("error", "Selecione ao menos uma especialidade para buscar cuidadores");
        }

        // BUSCAR CUIDADORES QUE TEM ESTA ESPECIALIDADE CADASTRADA
        $caregivers = Caregiver::whereHas('specialties', function ($query) use ($specialtyId) {
            $query->where('specialty_id', $specialtyId);
        })
            ->with([
                'user',
                'specialties' => function ($query) use ($specialtyId) {
                    $query->where('specialty_id', $specialtyId);
                }
            ])
            ->paginate(10);

        // RETORNAR OS CUIDADORES ENCONTRADOS PARA PAGINA select-specialty
       return redirect()->route('select.specialty')->with('caregivers', $caregivers);
    }
}
