<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        $token = $user->createToken('Access Token')->accessToken;

        return response([
            'token' => $token
        ], Response::HTTP_OK);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->get('email'))->sole();

        if (is_null($user)) {
            return response(['Incorrect credentials'], Response::HTTP_OK);
        }

        if (!Hash::check($request->get('password'), $user->password)) {
            return response(['Incorrect credentials'], Response::HTTP_OK);
        }

        $token = $user->createToken('Access Token')->accessToken;

        return response([
            'token' => $token
        ], Response::HTTP_OK);
    }

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();

        return response([
            'message' => 'You have been successfully logged out!'
        ], Response::HTTP_OK);
    }
}
