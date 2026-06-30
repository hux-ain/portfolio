<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillsController extends Controller
{
    /**
     * Display all skills grouped by category
     */
    public function index()
    {
        $skills = Skill::orderBy('order_number')->orderBy('name')->get();
        $groupedSkills = $skills->groupBy('category');

        // Get categories in order
        $categories = ['backend', 'frontend', 'devops', 'tools', 'other'];

        return view('skills', compact('groupedSkills', 'categories'));
    }
}
