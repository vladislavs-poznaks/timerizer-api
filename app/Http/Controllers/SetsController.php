<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetStoreRequest;
use App\Http\Resources\SetCollection;
use App\Http\Resources\SetResource;
use App\Models\Set;
use App\Models\Workout;

class SetsController extends Controller
{
    public function index(Workout $workout)
    {
        return response()->json(new SetCollection($workout->sets));
    }

    public function show(Set $set)
    {
        return response()->json(new SetResource($set));
    }

    public function store(SetStoreRequest $request, Workout $workout)
    {
        $set = $workout->sets()->create($request->validated());

        return response()->json(new SetResource($set));
    }
}
