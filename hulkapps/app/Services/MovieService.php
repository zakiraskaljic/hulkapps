<?php

namespace App\Services;

use App\Repositories\MovieRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MovieService
{
    protected MovieRepository $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function getAllMovies(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->movieRepository->getAll();
    }

    public function getMovie($param): ?\App\Models\Movie
    {
        try {
            return $this->movieRepository->getMovie($param);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function getMoviesByYearAndTitle($year, $title)
    {
        return $this->movieRepository->findByYearAndTitle($year, $title);
    }

    public function delete($param): bool
    {
        return $this->movieRepository->delete($param);
    }
}
