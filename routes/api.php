<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\CourseController;

// ✅ Route publik (tanpa login)
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// ✅ Route yang butuh login
Route::middleware('auth:sanctum')->group(function () {

    // 🔐 Ambil user yang sedang login
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // 📝 Route Notes (CRUD)
    Route::get('/notes', [NoteController::class, 'index']);
    Route::get('/notes/search', [NoteController::class, 'findByTitle']);
    Route::post('/notes/create', [NoteController::class, 'store']);
    Route::put('/notes/{id}', [NoteController::class, 'update']);
    Route::delete('/notes/{id}', [NoteController::class, 'destroy']);

    // 📚 Route Courses (CRUD)
    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/courses/search', [CourseController::class, 'findByTitle']);
    Route::post('/courses/create', [CourseController::class, 'store']);
    Route::put('/courses/{id}', [CourseController::class, 'update']);
    Route::delete('/courses/{id}', [CourseController::class, 'destroy']);
});
