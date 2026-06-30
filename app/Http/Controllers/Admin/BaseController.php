<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     * Constructer - automatically apply auth middleware
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(\App\Http\Middleware\AdminMiddleware::class);
    }

    /**
     * Helper method to get statistics for dashboard
     */
    protected function getStats()
    {
        return [
            'total_projects' => \App\Models\Project::count(),
            'total_skills' => \App\Models\Skill::count(),
            'total_experiences' => \App\Models\Experience::count(),
            'unread_messages' => \App\Models\Message::where('is_read', false)->count(),
        ];
    }
}
