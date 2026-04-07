<?php

namespace App\Http\Controllers;

use App\Models\Caregiver;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CaregiverController extends Controller
{
    public function index()
    {
        $caregivers = Caregiver::all();

        return view('client.find-caregivers', compact('caregivers'));
    }

    public function addSpecialty($id)
    {
        $caregiver = Caregiver::where('user_id', Auth::user()->id)->firstOrFail();

        $caregiver->specialties()->attach($id, [
            'preco_minimo' => 0 // ou valor padrão
        ]);

        return back();
    }

    public function removeSpecialty($id)
    {
        $caregiver = Caregiver::where('user_id', Auth::user()->id)->firstOrFail();
        $caregiver->specialties()->detach($id);

        return back();
    }

    public function showSpecialties()
    {
        $caregiver = Caregiver::with('specialties')
            ->where('user_id', Auth::user()->id)
            ->firstOrFail();

        //  Especialidades que ele JÁ TEM
        $mySpecialties = $caregiver->specialties;

        //  IDs das especialidades que ele já possui
        $mySpecialtiesIds = $mySpecialties->pluck('id');

        //  Especialidades que ele NÃO TEM
        $availableSpecialties = Specialty::whereNotIn('id', $mySpecialtiesIds)->get();

        return view('caregiver.specialties', compact(
            'mySpecialties',
            'availableSpecialties'
        ));
    }

    public function showProposals()
    {
        // Pega: cuidador logado + suas propostas + cliente + usuário do cliente
        $caregiver = Caregiver::with('proposals.client.user')
            ->where('user_id', Auth::user()->id)
            ->firstOrFail();

        $proposals = $caregiver->proposals;

        return view('caregiver.caregiver-proposals', compact('proposals'));
    }

    // public function showProposalStatus
}
