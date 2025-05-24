<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Course;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->query('user_id');
        return $userId
            ? Note::where('user_id', $userId)->get()
            : Note::all();
    }

    // Find course(s) by title (search)
    public function findByTitle(Request $request)
    {
        $title = $request->query('title');

        if (!$title) {
            return response()->json(['message' => 'Title query parameter is required'], 400);
        }

        $courses = Note::where('note_title', 'LIKE', '%' . $title . '%')->get();

        return response()->json($courses);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'note' => 'required|string',
        ]);

        $course = Course::findOrFail($validated['course_id']);
        $validated['note_title'] = $course->title;

        $note = Note::create($validated);

        return response()->json($note, 201);
    }

    public function update(Request $request, $id)
    {
        $note = Note::findOrFail($id);

        $validated = $request->validate([
            'note' => 'sometimes|required|string',
            // Biasanya user_id dan course_id tidak diubah setelah dibuat
        ]);

        $note->update($validated);

        return response()->json($note);
    }

    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        $note->delete();

        return response()->json(['message' => 'Note deleted successfully']);
    }
}
