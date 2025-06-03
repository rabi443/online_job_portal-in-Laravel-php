<?php

namespace App\Http\Controllers;

use App\Models\JobTitle;
use App\Models\JobCategory;
use Illuminate\Http\Request;

class JobTitleController extends Controller
{
    // Display all job titles
    public function index()
    {
        $titles = JobTitle::all();
        return response()->json($titles);
    }

    // Create a new job title
    public function store(Request $request)
    {
        $request->validate([
            'job_title' => 'required|string|max:255',
            'category_id' => 'required|exists:job_category,id',
        ]);

        $title = JobTitle::create([
            'job_title' => $request->job_title,
            'category_id' => $request->category_id,
        ]);

        return response()->json($title, 201);
    }

    // Show a specific job title
    public function show($id)
    {
        $title = JobTitle::findOrFail($id);
        return response()->json($title);
    }

    // Update a job title
    public function update(Request $request, $id)
    {
        $title = JobTitle::findOrFail($id);

        $title->update([
            'job_title' => $request->job_title,
            'category_id' => $request->category_id,
        ]);

        return response()->json($title);
    }

    // Delete a job title
    public function destroy($id)
    {
        $title = JobTitle::findOrFail($id);
        $title->delete();
        return response()->json(['message' => 'Job title deleted successfully']);
    }
}
