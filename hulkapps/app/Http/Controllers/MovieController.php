<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterMovieRequest;
use App\Http\Resources\MovieResource;
use App\Services\MovieService;

class MovieController extends Controller
{
    protected MovieService $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function index(): \Illuminate\Http\JsonResponse
    {
        $movies = $this->movieService->getAllMovies();
        return response()->json(MovieResource::collection($movies));
    }

    public function show($param): \Illuminate\Http\JsonResponse
    {
        $movie = $this->movieService->getMovie($param);

        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        return response()->json(new MovieResource($movie));
    }

    public function getMoviesByYearAndTitle(FilterMovieRequest $request): \Illuminate\Http\JsonResponse
    {
        $year = $request->input('year');
        $title = $request->input('title');

        $movies = $this->movieService->getMoviesByYearAndTitle($year, $title);

        return response()->json(MovieResource::collection($movies));
    }

    public function destroy($param): \Illuminate\Http\JsonResponse
    {
        $success = $this->movieService->delete($param);

        if ($success) {
            return response()->json(['message' => 'Movie deleted successfully']);
        } else {
            return response()->json(['message' => 'Movie not found'], 404);
        }
    }
}

