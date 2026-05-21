<?php

namespace App\Http\Controllers;

use App\Models\Caregiver;
use App\Models\User;
use App\Models\Specialty;
use App\Models\Proposal;
use App\Models\Review;

use Illuminate\Http\Request;
use App\Helpers\DistanceHelper;
use App\Helpers\SlugHelper;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function showDashboard()
    {
        $client = Auth::user()->client;

        $recentProposals = Proposal::with([
            'caregiver.user',
            'review'
        ])
            ->where('client_id', $client->id)
            ->whereIn('status', ['pending', 'accepted', 'completed'])
            ->latest()
            ->limit(5)
            ->get();

        $totalRequests = Proposal::where('client_id', $client->id)->count();

        $activeRequests = Proposal::where('client_id', $client->id)
            ->whereIn('status', ['accepted', 'in_progress'])
            ->count();

        $completedRequests = Proposal::where('client_id', $client->id)
            ->where('status', 'completed')
            ->count();

        $pendingRequests = Proposal::where('client_id', $client->id)
            ->where('status', 'pending')
            ->count();

        $totalReviews = Review::where('client_id', $client->id)
            ->count();

        $averageRating = Review::where('client_id', $client->id)
            ->avg('rating');

        $pendingReviews = Proposal::with('caregiver.user')
            ->where('client_id', $client->id)
            ->where('status', 'completed')
            ->whereDoesntHave('review')
            ->latest()
            ->get();

        $recentChats = Conversation::where('client_user_id', Auth::id())
            ->orderby('last_message_at', 'desc')
            ->limit(5)
            ->get();

        return view('client.dashboard-client', compact(
            'recentProposals',
            'totalRequests',
            'activeRequests',
            'completedRequests',
            'pendingRequests',
            'totalReviews',
            'averageRating',
            'pendingReviews',
            'recentChats',
        ));
    }

    public function searchCaregiver(Request $request)
    {
        $client = $request->user();
        $clientLat = null;
        $clientLng = null;

        if ($client && $client->address) {
            $clientLat = $client->address->latitude;
            $clientLng = $client->address->longitude;
        }

        // leva pro front
        $specialties = Specialty::all();

        // leva pro filtro
        $selectedSpecialties = $request->input('specialties', []);

        // faz em partes, montando uma query
        // primeiro pega o cuidador, carregando seus dados de usuario e especialidades
        // tambem envia reviews, 3 mais recentes
        $query = Caregiver::with([
            'user.address',
            'specialties',
            'reviews' => function ($q) {
                $q->with('user:id,nome')
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


        if ($request->filled('search')) {

            $search = $request->search;
            $slug = SlugHelper::format($search);

            $query->whereHas('user', function ($q) use ($search, $slug) {

                $q->where(function ($sub) use ($search, $slug) {

                    $sub->where('slug', 'like', "%{$slug}%")
                        ->orWhere('nome', 'like', "%{$search}%")
                        ->orWhere('public_code', 'like', "%{$search}%");
                });
            });
        }

        // paginate sempre por ultimo
        $caregivers = $query->paginate(10)->withQueryString();

        // calcula distancia
        if (!Auth::guest()) {
            foreach ($caregivers as $caregiver) {

                $lat = $caregiver->user->address->latitude ?? null;
                $lng = $caregiver->user->address->longitude ?? null;

                if ($lat && $lng && $clientLat && $clientLng) {
                    $caregiver->distance = round(
                        DistanceHelper::calculate($clientLat, $clientLng, $lat, $lng),
                        1
                    );
                } else {
                    $caregiver->distance = null;
                }
            }
        }

        return view('client.searchCaregiver', compact('specialties', 'caregivers'));
    }
}
