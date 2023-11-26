<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserMovie extends Pivot
{
    use HasFactory;

    protected $fillable = ['user_id', 'movie_id'];

    protected $table = 'user_movies';
}
