<?php

use App\Http\Controllers\ApiAuthController;
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


    });
});
