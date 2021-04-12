<?php

namespace App\Http\Controllers;

use App\Domain\Authentications\CreateOrUpdateAuthenticationAction;
use App\Http\Requests\LoginPassportAuthRequest;
use App\Http\Requests\RegisteredPassportAuthRequest;
use Illuminate\Http\JsonResponse;
use App\Models\User;

class AuthController extends Controller
{
    public function register(RegisteredPassportAuthRequest $request): JsonResponse
    {
        $user = CreateOrUpdateAuthenticationAction::execute($request, new User());

        $token = $user->createToken(config('auth.token'))->accessToken;

        return response()->json(['token' => $token], 200);
    }

    public function login(LoginPassportAuthRequest $request): JsonResponse
    {
        if (auth()->attempt($request->validated())) {
            $token = auth()->user()->createToken(config('auth.token'))->accessToken;

            return response()->json(['token' => $token]);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }

    }
}
