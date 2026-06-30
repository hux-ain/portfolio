<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show portfolio home page (Hero + About + Preview)
     */
    public function index()
    {
        // Get featured projects (first 3)
        $featuredProjects = Project::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('order_number')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Get featured skills organized by category
        $skills = Skill::where('is_featured', true)
            ->orderBy('category')
            ->orderBy('order_number')
            ->get()
            ->groupBy('category');

        // Define categories order
        $categories = ['backend', 'frontend', 'devops', 'tools', 'other'];

        // Get current/ recent experiences
        $experiences = Experience::orderBy('start_date', 'desc')
            ->orderBy('order_number')
            ->take(3)
            ->get();

        // Profile data - you can change these values here or create admin settings later
        $profile = [
            'name' => 'Muhammad-ul-Hussain',
            'social_name' => 'Hux_Ain', // Set to non-empty to show greeting
            'title' => 'Full-Stack Laravel Developer',
            'subtitle' => 'Building scalable web applications, REST APIs, and managing Linux deployments. Currently working at Gerry\'s IT.',
            'phone' => '03341022301',
            'email' => 'hussain@example.com', // Change this
            'about' => 'I am a BS-SE student at Iqra University and a Web Developer at Gerry\'s IT. I love solving problems and writing clean, maintainable code. My expertise lies in Laravel development, MySQL optimization, and Linux server management.',
            'linkedin' => 'https://linkedin.com/in/hux-ain', // Change this
            'github' => 'https://github.com/Hux_Ain', // Change this
        ];

        return view('welcome', compact('featuredProjects', 'skills', 'categories', 'experiences', 'profile'));
    }
}
