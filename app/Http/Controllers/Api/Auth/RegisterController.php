<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;

class RegisterController extends Controller {

    public function __invoke(RegisterRequest $request) {
        $user = User::create($request->validated());

        return successResponse(UserResource::make($user), message: __('User created successfully!'));
    }
}
