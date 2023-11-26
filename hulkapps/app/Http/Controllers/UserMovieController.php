<?php

namespace App\Http\Controllers;

use App\Http\Requests\FollowMovieRequest;
use App\Http\Resources\MovieResource;
use App\Services\UserMovieService;

class UserMovieController extends Controller
{
    protected UserMovieService $userMovieService;

    public function __construct(UserMovieService $userMovieService)
    {
        $this->userMovieService = $userMovieService;
    }

    public function index(): \Illuminate\Http\JsonResponse
    {
        $movies = $this->userMovieService->getUserMovies();
        return response()->json(MovieResource::collection($movies));
    }

    public function store(FollowMovieRequest $request): MovieResource
    {
        $movie = $this->userMovieService->followMovie($request->id);
        return new MovieResource($movie);
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $this->userMovieService->unfollowMovie($id);
        return response()->json(['message' => 'Movie unfollowed successfully']);
    }
}
