<?php

namespace App\Http\Controllers;

use App\Models\Caregiver;
use App\Models\User;
use App\Models\Proposal;
use App\Models\Review;
use App\Notifications\NewProposalNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReviewController extends Controller
{
    public function showReview(Request $request)
    {
        // dd($request->all());

        $rating = $request->rating;

        $caregiver = Auth::user()->caregiver;

        $reviews = Review::where('caregiver_id', $caregiver->id)
            ->with('client.user');

        if ($request->sort_time == 'newest') {
            $reviews->latest();
        } elseif ($request->sort_time == 'oldest') {
            $reviews->oldest();;
        }

        if ($request->sort_rating == 'highest_rating') {
            $reviews->orderBy('rating', 'desc');
        } elseif ($request->sort_rating == 'lowest_rating') {
            $reviews->orderBy('rating', 'asc');
        }

        if (!empty($rating)) {
            $reviews->whereIn('rating', $rating);
        }

        $reviews = $reviews->paginate(10);

        return view('caregiver.caregiver-reviews', compact('reviews', 'caregiver'));
    }

    public function rateCaregiver(Request $request)
    {
        // dd($request->all());
        $user = $request->user();

        $rules = [
            'proposal_id' => 'required|exists:proposals,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ];
        $messages = [
            'rating.required' => 'A avaliação é obrigatória',
            'rating.integer' => 'A avaliação deve ser um número inteiro',
            'rating.min' => 'A avaliação deve ser no mínimo :min estrela',
            'rating.max' => 'A avaliação deve ser no máximo :max estrelas',
            'comment.string' => 'O comentário deve ser uma string',
            'comment.max' => 'O comentário deve ter no máximo :max caracteres',
        ];

        $validated = $request->validate($rules, $messages);

        // pega a proposta, garantindo que ela exista, que pertença ao cliente e que esteja concluída
        $proposal = Proposal::where('id', $validated['proposal_id'])
            ->where('client_id', $user->client->id)
            ->where('status', 'completed')
            ->firstOrFail();

        if ($proposal->review) {
            return back()->with('error', 'Esta proposta já foi avaliada');
        }

        Review::create([
            'proposal_id' => $proposal->id,
            'caregiver_id' => $proposal->caregiver_id,
            'client_id' => $proposal->client_id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? '',

            // n sei se vai ser implementado
            // 'revisor_id' => null,
            // 'revisado_id' => null,
        ]);

        return back()->with('success', 'Cuidador avaliado com sucesso!');
    }
}
