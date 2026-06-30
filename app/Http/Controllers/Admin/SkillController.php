<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends BaseController
{
    public function index()
    {
        $skills = Skill::orderBy('order_number')->orderBy('category')->paginate(15);
        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        $categories = ['backend', 'frontend', 'devops', 'tools', 'other'];
        return view('admin.skills.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:skills',
            'category' => 'required|in:backend,frontend,devops,tools,other',
            'icon_class' => 'nullable|string|max:100',
            'proficiency_level' => 'required|integer|min:0|max:100',
            'order_number' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
        ]);

        Skill::create($validated);
        return redirect()->route('admin.skills.index')->with('success', 'Skill added successfully!');
    }

    public function edit(Skill $skill)
    {
        $categories = ['backend', 'frontend', 'devops', 'tools', 'other'];
        return view('admin.skills.edit', compact('skill', 'categories'));
    }

    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:skills,name,' . $skill->id,
            'category' => 'required|in:backend,frontend,devops,tools,other',
            'icon_class' => 'nullable|string|max:100',
            'proficiency_level' => 'required|integer|min:0|max:100',
            'order_number' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
        ]);

        $skill->update($validated);
        return redirect()->route('admin.skills.index')->with('success', 'Skill updated successfully!');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('admin.skills.index')->with('success', 'Skill deleted successfully!');
    }
}
