<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetStoreRequest;
use App\Http\Resources\SetCollection;
use App\Http\Resources\SetResource;
use App\Models\Set;
use App\Models\Workout;
use Illuminate\Http\Response;

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

        return response()->json(new SetResource($set), Response::HTTP_CREATED);
    }

    // TODO For updating need to think about type related variables

    public function destroy(Set $set)
    {
        $set->delete();

        return response()->json([
            "message" => "Successfully deleted!"
        ], Response::HTTP_OK);
    }
}
