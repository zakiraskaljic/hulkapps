<?php

namespace App\Repositories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\QueryBuilder\QueryBuilder;

class MovieRepository
{
    protected Movie $movie;

    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    public function getAll(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return QueryBuilder::for(Movie::class)
            ->paginate(10);
    }

    public function getById(int $id): Movie
    {
        return $this->movie->findOrFail($id);
    }

    public function getBySlug(string $slug): Movie
    {
        return $this->movie->where('slug', $slug)->firstOrFail();
    }

    public function getMovie($param)
    {
        if (is_numeric($param)) {
            return $this->getById($param);
        } elseif (is_string($param)) {
            return $this->getBySlug($param);
        }

        throw new \InvalidArgumentException("Invalid parameter type");
    }

    public function findByYearAndTitle($year, $title)
    {
        return Movie::where(function ($query) use ($year, $title) {
            $query->where('year', $year);

            if ($title !== null) {
                $query->orWhere('title', $title);
            }
        })->get();
    }

    public function delete($param): bool
    {
        try {
            $movie = $this->getMovie($param);

            if ($movie) {
                return $movie->delete();
            }
            return false;
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }

}
