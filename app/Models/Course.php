<?php

namespace App\Models;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        //'user_id',
        'title',
        'url',
        'description',
        'created_by',
        'level',
    ];

    public function note(){
        return $this->hasMany(Note::class);
    }

    // public function user(){
    //     return $this->belongsTo(User::class);
    // }
}
