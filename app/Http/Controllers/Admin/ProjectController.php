<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends BaseController
{
    /**
     * Display list of projects
     */
    public function index()
    {
        $projects = Project::orderBy('order_number')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store new project
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tech_stack' => 'nullable|array',
            'tech_stack.*' => 'string|max:100',
            'github_link' => 'nullable|url|max:500',
            'live_link' => 'nullable|url|max:500',
            'order_number' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/projects'), $imageName);
            $validated['image_path'] = 'projects/' . $imageName;
        }

        Project::create($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully!');
    }

    /**
     * Show edit form
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update project
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tech_stack' => 'nullable|array',
            'tech_stack.*' => 'string|max:100',
            'github_link' => 'nullable|url|max:500',
            'live_link' => 'nullable|url|max:500',
            'order_number' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle new image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($project->image_path && file_exists(public_path('images/' . $project->image_path))) {
                unlink(public_path('images/' . $project->image_path));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/projects'), $imageName);
            $validated['image_path'] = 'projects/' . $imageName;
        }

        $project->update($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully!');
    }

    /**
     * Delete project
     */
    public function destroy(Project $project)
    {
        // Delete image if exists
        if ($project->image_path && file_exists(public_path('images/' . $project->image_path))) {
            unlink(public_path('images/' . $project->image_path));
        }

        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully!');
    }
}
