<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    /**
     * Display admin dashboard
     */
    public function index()
    {
        $stats = $this->getStats();

        $recentProjects = \App\Models\Project::latest()->take(5)->get();
        $recentMessages = \App\Models\Message::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentProjects', 'recentMessages'));
    }
}
