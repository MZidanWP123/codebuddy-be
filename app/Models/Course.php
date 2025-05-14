<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'url',
        'description',
        'thumbnail',
        'created_by',
        'level'
    ];
}
