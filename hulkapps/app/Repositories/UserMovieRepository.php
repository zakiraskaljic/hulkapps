<?php

namespace App\Repositories;

use App\Models\Movie;

class UserMovieRepository
{
    public function getUserMovies($user): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $movies = $user->movies();

        return $movies->paginate(10);
    }

    public function followMovie($user, Movie $movie): void
    {
        $user->movies()->attach($movie->id);
    }

    public function unfollowMovie($user, $movieId): void
    {
        $user->movies()->detach($movieId);
    }
}
