<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {

    public function __invoke(LoginRequest $request) {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return errorResponse(message: __('Invalid credentials!'));
        }

        $user = auth('sanctum')->user();

        $token = $user->createToken('auth_token')->plainTextToken;

        return successResponse(UserResource::make($user), message: __('User created successfully!'), extra: [
            'token' => $token
        ]);
    }
}
