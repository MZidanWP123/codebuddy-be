<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\CourseController;

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/courses', [CourseController::class, 'index']); // list semua course
Route::get('/courses/search', [CourseController::class, 'findByTitle']); // cari course by title
Route::post('/courses/create', [CourseController::class, 'store']); // buat course (opsional, admin)
Route::put('/courses/{id}', [CourseController::class, 'update']); // edit course
Route::delete('/courses/{id}', [CourseController::class, 'destroy']); // hapus course

Route::get('/notes', [NoteController::class, 'index']); // list semua notes (bisa difilter user_id)
Route::get('/notes/search', [NoteController::class, 'findByTitle']); // cari notes by title
Route::post('/notes/create', [NoteController::class, 'store']); // buat note baru
Route::put('/notes/{id}', [NoteController::class, 'update']); // update note
Route::delete('/notes/{id}', [NoteController::class, 'destroy']); // hapus note