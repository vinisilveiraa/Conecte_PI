<?php

namespace App\Http\Controllers;

use App\Models\Caregiver;
use App\Models\Specialty;
use App\Models\Proposal;
use App\Models\Client;
use App\Models\Review;
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

        if ($caregiver->specialties()->where('specialty_id', $id)->exists()) {
            return back()->with('error', 'Especialidade já adicionada.');
        }

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

    public function showDashboard()
    {
        $caregiverId = Auth::user()->caregiver->id;

        $proposals = Proposal::with('client.user')
            ->where('caregiver_id', $caregiverId)
            ->where('status', 'accepted')
            ->latest()
            ->limit(3)
            ->get();

        $reviews = Review::with('client.user')
            ->where('caregiver_id', $caregiverId)
            ->latest()
            ->limit(3)
            ->get();

        $totalProposals = Proposal::where('caregiver_id', $caregiverId)
            ->where('status', 'completed')
            ->count();

        $totalReviews = Review::where('caregiver_id', $caregiverId)
            ->count();

        $averageRating = Review::where('caregiver_id', $caregiverId)
            ->avg('rating');

        return view('caregiver.dashboard-caregiver', compact(
            'proposals',
            'reviews',
            'totalProposals',
            'totalReviews',
            'averageRating'
        ));
    }
}
