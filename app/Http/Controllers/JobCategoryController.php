<?php

namespace App\Http\Controllers;

use App\Models\JobCategory;
use Illuminate\Http\Request;

class JobCategoryController extends Controller
{
    // Display all job categories
    public function index()
    {
        $categories = JobCategory::all();
        return response()->json($categories);
    }

    // Create a new job category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = JobCategory::create([
            'name' => $request->name,
        ]);

        return response()->json($category, 201);
    }

    // Show a specific job category
    public function show($id)
    {
        $category = JobCategory::findOrFail($id);
        return response()->json($category);
    }

    // Update a job category
    public function update(Request $request, $id)
    {
        $category = JobCategory::findOrFail($id);

        $category->update([
            'name' => $request->name,
        ]);

        return response()->json($category);
    }

    // Delete a job category
    public function destroy($id)
    {
        $category = JobCategory::findOrFail($id);
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully']);
    }
}
