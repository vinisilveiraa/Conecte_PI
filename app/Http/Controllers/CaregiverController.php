<?php

namespace App\Http\Controllers;

use App\Models\Caregiver;
use App\Models\Specialty;
use App\Models\Proposal;
use App\Models\Client;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Helpers\SlugHelper;


class CaregiverController extends Controller
{
    public function index()
    {
        $caregivers = Caregiver::all();

        return view('client.find-caregivers', compact('caregivers'));
    }

    public function certificate($id)
    {
        $caregiver = Caregiver::findOrFail($id);

        // REGRAS DE ACESSO
        // ex: só dono ou admin ou clientes autenticados, ta aberto pra todos por enquanto
        if (!Auth::check()) {
            abort(403);
        }

        $path = storage_path(
            'app/private/' . $caregiver->certificado_cuidador
        );

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
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

    public function checkSlug(Request $request)
    {
        $slug = SlugHelper::format($request->slug);

        $available = SlugHelper::isAvailable(
            $slug,
            $request->user()->caregiver->id ?? null
        );

        return response()->json([
            'slug' => $slug,
            'available' => $available
        ]);
    }

    public function UpdateCaregiverForm()
    {
        $caregiver = Auth::user()->caregiver;

        return view('caregiver.edit-caregiverProfile', compact('caregiver'));
    }

    public function UpdateCaregiver(Request $request)
    {
        $caregiver = $request->user()->caregiver;

        $rules = [
            'slug' => [
                'string',
                'min:3',
                'max:24',
                'regex:/^[a-zA-Z0-9\-]+$/',
                'unique:caregivers,slug,' . $caregiver->id
            ],

            'coren' => [
                'nullable',
                'string',
                'max:20',
                'required_without:certificado_cuidador'
            ],

            'certificado_cuidador' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:2048',
                'required_without:coren'
            ],

            'headline' => [
                'nullable',
                'string',
                'max:120'
            ],

            'bio' => [
                'nullable',
                'string',
                'max:1000'
            ],

            'hour_price' => [
                'nullable',
                'numeric',
                'min:0',
                'max:9999.99'
            ],

            'experience_years' => [
                'nullable',
                'integer',
                'min:0',
                'max:80'
            ],

            // DISPONIBILIDADE
            'available_morning' => [
                'nullable',
                'boolean'
            ],

            'available_afternoon' => [
                'nullable',
                'boolean'
            ],

            'available_night' => [
                'nullable',
                'boolean'
            ],

            'available_weekends' => [
                'nullable',
                'boolean'
            ],
        ];

        $messages = [
            'slug.min' => 'O nome de usuário deve ter no mínimo 3 caracteres.',
            'slug.max' => 'O nome de usuário deve ter no máximo 12 caracteres.',
            'slug.unique' => 'Esse nome de usuário já está em uso.',
            'slug.regex' => 'O nome de usuário pode conter apenas letras, números e hífens.',

            'coren.required_without' => 'Informe um COREN ou envie um certificado.',
            'coren.max' => 'O COREN é muito longo.',

            'certificado_cuidador.required_without' =>
            'Envie um certificado ou informe um COREN.',

            'certificado_cuidador.mimes' =>
            'O certificado deve ser JPG, PNG ou PDF.',

            'certificado_cuidador.max' =>
            'O certificado deve ter no máximo 2MB.',

            'headline.max' =>
            'A headline deve ter no máximo 120 caracteres.',

            'bio.max' =>
            'A biografia deve ter no máximo 1000 caracteres.',

            'hour_price.numeric' =>
            'O valor por hora deve ser numérico.',

            'hour_price.min' =>
            'O valor por hora não pode ser negativo.',

            'experience_years.integer' =>
            'Os anos de experiência devem ser um número inteiro.',

            'experience_years.max' =>
            'Os anos de experiência não pode ser maior que 80.',

            'experience_years.min' =>
            'Os anos de experiência não podem ser negativos.',
        ];

        $validated = $request->validate($rules, $messages);

        $validated['slug'] = SlugHelper::format($validated['slug']);

        $validated['available_morning'] = $request->boolean('available_morning');
        $validated['available_afternoon'] = $request->boolean('available_afternoon');
        $validated['available_night'] = $request->boolean('available_night');
        $validated['available_weekends'] = $request->boolean('available_weekends');

        if ($request->hasFile('certificado_cuidador')) {

            if ($caregiver->certificado_cuidador) {

                Storage::delete($caregiver->certificado_cuidador);
            }

            $validated['certificado_cuidador'] =
                $request->file('certificado_cuidador')
                ->store('certificados/' . $caregiver->id);
        }

        $caregiver->update($validated);

        return redirect()
            ->back()
            ->with('success', 'Perfil profissional atualizado com sucesso.');
    }

    public function PublicProfile($slug)
    {
        $caregiver = Caregiver::where('slug', $slug)
            ->with([
                'specialties',
                'user',
                'user.address',
                'reviews',
                'reviews.client'
            ])
            ->firstOrFail();

        $caregiverId = $caregiver->id;

        $totalProposals = Proposal::where('caregiver_id', $caregiverId)
            ->where('status', 'completed')
            ->count();

        $totalReviews = $caregiver->reviews->count();

        $averageRating = $totalReviews
            ? round($caregiver->reviews->avg('rating'), 1)
            : 0;

        $satisfaction_rate = $averageRating
            ? round(($averageRating / 5) * 100)
            : 0;

        return view('caregiver.public-profile', compact(
            'caregiver',
            'totalProposals',
            'totalReviews',
            'averageRating',
            'satisfaction_rate'
        ));
    }
}
