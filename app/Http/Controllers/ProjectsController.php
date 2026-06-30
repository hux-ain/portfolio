<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * Display all projects
     */
    public function index()
    {
        $projects = Project::where('is_active', true)
            ->orderBy('is_featured', 'desc')
            ->orderBy('order_number')
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('projects', compact('projects'));
    }
}
