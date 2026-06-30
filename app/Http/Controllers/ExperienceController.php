<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display experience timeline
     */
    public function index()
    {
        $experiences = Experience::orderBy('start_date', 'desc')
            ->orderBy('order_number')
            ->get();

        // Separate work experience and education
        $workExperience = $experiences->where('company', '!=', 'Iqra University')->values();
        $education = $experiences->where('company', 'Iqra University')->values();

        return view('experience', compact('workExperience', 'education'));
    }
}
