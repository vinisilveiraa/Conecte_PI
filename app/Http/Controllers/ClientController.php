<?php

namespace App\Http\Controllers;

use App\Models\Caregiver;
use App\Models\User;
use App\Models\Specialty;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function searchCaregiver(Request $request)
    {
        // leva pro front
        $specialties = Specialty::all();

        // leva pro filtro
        $selectedSpecialties = $request->input('specialties', []);

        // faz em partes, montando uma query
        // primeiro pega o cuidador, carregando seus dados de usuario e especialidades
        // tambem envia reviews, 3 mais recentes
        $query = Caregiver::with([
            'user',
            'specialties',
            'reviews' => function ($q) {
                $q->with('user')
                    ->latest()->take(3);
            }
        ])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews');

        // se tiver especialidades, inclui elas na query
        if (!empty($selectedSpecialties)) {
            $query->whereHas('specialties', function ($q) use ($selectedSpecialties) {
                $q->whereIn('specialty_id', $selectedSpecialties);
            });
        }

        // sorta de acordo
        if ($request->sort == "reviews") {
            $query->orderBy('reviews_count', 'desc');
        } elseif ($request->sort == "rating") {
            $query->orderBy('reviews_avg_rating', 'desc');
        } elseif ($request->sort == "newest") {
            $query->latest(); // usa created_at
        }

        // paginate sempre por ultimo
        $caregivers = $query->paginate(10)->withQueryString();

        return view('client.searchCaregiver', compact('specialties', 'caregivers'));
    }
}
