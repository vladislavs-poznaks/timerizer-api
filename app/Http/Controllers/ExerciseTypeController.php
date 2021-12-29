<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExerciseTypeStoreRequest;
use App\Http\Resources\ExerciseTypeCollection;
use App\Http\Resources\ExerciseTypeResource;
use App\Models\ExerciseType;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ExerciseTypeController extends Controller
{
    public function index()
    {
        return response()->json(new ExerciseTypeCollection(auth()->user()->exercises));
    }

    public function show(ExerciseType $exerciseType)
    {
        return response()->json(new ExerciseTypeResource($exerciseType));
    }

    public function store(ExerciseTypeStoreRequest $request)
    {
        $exerciseType = auth()->user()->exercises()->create($request->validated());

        return response()->json(new ExerciseTypeResource($exerciseType));
    }

    public function destroy(ExerciseType $exerciseType)
    {
        $exerciseType->delete();

        return response()->json([
            "message" => "Successfully deleted!"
        ], Response::HTTP_OK);
    }
}
