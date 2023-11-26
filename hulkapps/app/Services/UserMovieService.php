<?php

namespace App\Services;

use App\Models\Movie;
use App\Repositories\UserMovieRepository;
use Illuminate\Support\Facades\Auth;

class UserMovieService
{
    protected UserMovieRepository $userMovieRepository;

    /**
     * UserMovieService constructor.
     *
     * @param UserMovieRepository $userMovieRepository
     */
    public function __construct(UserMovieRepository $userMovieRepository)
    {
        $this->userMovieRepository = $userMovieRepository;
    }

    public function getUserMovies(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $user = Auth::user();
        return $this->userMovieRepository->getUserMovies($user);
    }

    public function followMovie(int $movieId): Movie
    {
        $user = Auth::user();
        $movie = Movie::findOrFail($movieId);

        if ($user->movies()->where('movie_id', $movie->id)->exists()) {
            throw new \RuntimeException('Movie already followed.');
        }

        $this->userMovieRepository->followMovie($user, $movie);
        return $movie;
    }

    public function unfollowMovie(int $movieId): void
    {
        $user = Auth::user();
        $this->userMovieRepository->unfollowMovie($user, $movieId);
    }
}
