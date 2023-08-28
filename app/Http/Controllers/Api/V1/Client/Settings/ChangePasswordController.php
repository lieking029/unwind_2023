<?php

namespace App\Http\Controllers\Api\V1\Client\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Shared\ChangePasswordRequest;
use App\Http\Resources\Api\V1\User\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function __invoke(ChangePasswordRequest $request) : JsonResponse
    {
        $user = auth()->user();
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid Password'], Response::HTTP_BAD_REQUEST);
        }

        $user->update($request->only('password'));
        return response()->json(UserResource::make($user), Response::HTTP_ACCEPTED);
    }
}
