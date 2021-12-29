<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ExercisesController;
use App\Http\Controllers\ExerciseTypeController;
use App\Http\Controllers\SetsController;
use App\Http\Controllers\WorkoutsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'v1',
    'middleware' => ['cors', 'json']
], function () {

    Route::post('login', [ApiAuthController::class, 'login'])
        ->name('auth.login');
    Route::post('register', [ApiAuthController::class, 'register'])
        ->name('auth.register');

    Route::group([
        'middleware' => ['auth:api']
    ], function () {
        Route::get('user', function (Request $request) {
            return $request->user();
        });
        Route::post('logout', [ApiAuthController::class, 'logout'])
            ->name('auth.logout');

        Route::get('workouts', [WorkoutsController::class, 'index'])
            ->name('workouts.index');
        Route::get('workouts/{workout}', [WorkoutsController::class, 'show'])
            ->name('workouts.show');
        Route::post('workouts', [WorkoutsController::class, 'store'])
            ->name('workouts.store');
        Route::match([Request::METHOD_PUT, Request::METHOD_PATCH], 'workouts/{workout}', [WorkoutsController::class, 'update'])
//            ->middleware('can:update,workout')
            ->name('workouts.update');
        Route::delete('workouts/{workout}', [WorkoutsController::class, 'destroy'])
//            ->middleware('can:delete,workout')
            ->name('workouts.delete');

        Route::get('workouts/{workout}/sets', [SetsController::class, 'index'])
            ->name('sets.index');
        Route::get('workouts/sets/{set}', [SetsController::class, 'show'])
            ->name('sets.show');
        Route::post('workouts/{workout}/sets', [SetsController::class, 'store'])
            ->name('sets.store');
        Route::match([Request::METHOD_PUT, Request::METHOD_PATCH],'workouts/sets/{set}', [SetsController::class, 'update'])
            ->name('sets.update');
        Route::delete('workouts/sets/{set}', [SetsController::class, 'destroy'])
            ->name('sets.destroy');

        Route::get('exercise-types', [ExerciseTypeController::class, 'index'])
            ->name('exercise-types.index');
        Route::get('exercise-types/{exerciseType}', [ExerciseTypeController::class, 'show'])
            ->name('exercise-types.show');
        Route::post('exercise-types', [ExerciseTypeController::class, 'store'])
            ->name('exercise-types.store');

        Route::delete('exercise-types/{exerciseType}', [ExerciseTypeController::class, 'destroy'])
            ->name('exercise-types.destroy');

        Route::get('workouts/sets/{set}/exercises', [ExercisesController::class, 'index'])
            ->name('exercises.index');
        Route::post('workouts/sets/{set}/exercises', [ExercisesController::class, 'store'])
            ->name('exercises.store');
    });
});
