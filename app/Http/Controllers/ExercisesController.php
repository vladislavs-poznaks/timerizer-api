<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExerciseStoreRequest;
use App\Http\Resources\ExerciseCollection;
use App\Http\Resources\ExerciseResource;
use App\Models\Set;
use Illuminate\Http\Response;

class ExercisesController extends Controller
{
    public function index(Set $set)
    {
        return response()->json(new ExerciseCollection($set->exercises));
    }

    public function store(ExerciseStoreRequest $request, Set $set)
    {
        $exercise = $set->exercises()->create($request->validated());

        return response()->json(new ExerciseResource($exercise), Response::HTTP_CREATED);
    }
}
