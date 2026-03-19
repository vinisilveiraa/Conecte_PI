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

    public function add($id)
    {
        $caregiver = Auth::user()->caregiver;

        $caregiver->specialties()->attach($id);

        return back();
    }

    public function remove($id)
    {
        $caregiver = Auth::user()->caregiver;

        $caregiver->specialties()->detach($id);

        return back();
    }

    public function addSpecialty()
    {
        $specialties = Specialty::all();
        return view('caregiver.specialties', compact('specialties'));
    }
}
