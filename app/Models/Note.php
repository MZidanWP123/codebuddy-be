<?php

namespace App\Models;

use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'note_title',
        'user_id',
        'course_id',
        'note',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function course(){
        return $this->belongsTo(Course::class); 
    }
}
