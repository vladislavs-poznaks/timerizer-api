<?php

namespace App\Http\Controllers;


use App\Constants\SetDictionaries;
use App\Http\Requests\WorkoutStoreRequest;
use App\Http\Requests\WorkoutUpdateRequest;
use App\Http\Resources\DefinitionCollection;
use App\Http\Resources\ExerciseTypeCollection;
use App\Http\Resources\WorkoutCollection;
use App\Http\Resources\WorkoutResource;
use App\Models\Definition;
use App\Models\ExerciseType;
use App\Models\Workout;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;

class WorkoutsController extends Controller
{
    public function index()
    {
        return response()->json(new WorkoutCollection(auth()->user()->workouts()->paginate(10)->withQueryString()), Response::HTTP_OK);
    }

    public function show(Workout $workout)
    {
        return response()->json(new WorkoutResource($workout), Response::HTTP_OK);
//        $setTypes = new DefinitionCollection(Definition::inDictionary(SetDictionaries::TYPE)->orderBy('value')->get());
//
//        $filters = request()->only('type');
//
//        return inertia('Workouts/Show', [
//            'workout' => new WorkoutResource($workout),
//            'setTypes' => $setTypes,
//            'exerciseTypes' => new ExerciseTypeCollection(ExerciseType::all())
//        ]);
    }

    public function store(WorkoutStoreRequest $request)
    {
        $workout = auth()->user()->workouts()->create($request->validated());

        return response()->json(new WorkoutResource($workout), Response::HTTP_CREATED);
    }

    public function update(WorkoutUpdateRequest $request, Workout $workout)
    {
        $workout->update($request->validated());

        return response()->json(new WorkoutResource($workout), Response::HTTP_OK);
    }

    public function destroy(Workout $workout)
    {
        $workout->delete();

        return response()->json([
            "message" => "Successfully deleted!"
        ], Response::HTTP_OK);
    }
}
