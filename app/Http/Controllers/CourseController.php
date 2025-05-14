<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return Course::all();
    }

    // Create new course
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url|unique:courses',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|url',
            'created_by' => 'required|string|max:255',
            'level' => 'required|in:beginner,intermediate,advanced',
        ]);

        $course = Course::create($validated);

        return response()->json($course, 201);
    }

    // Get one course
    public function show($id)
    {
        return Course::findOrFail($id);
    }

    // Update course
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'url' => 'sometimes|required|url|unique:courses,url,' . $id,
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|url',
            'created_by' => 'sometimes|required|string|max:255',
            'level' => 'sometimes|required|in:beginner,intermediate,advanced',
        ]);

        $course->update($validated);

        return response()->json($course);
    }

    // Delete course
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return response()->json(['message' => 'Course deleted']);
    }
}
