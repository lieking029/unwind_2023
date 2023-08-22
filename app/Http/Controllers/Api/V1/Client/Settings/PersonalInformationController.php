<?php

namespace App\Http\Controllers\Api\V1\Client\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Client\UpdatePersonalInformationRequest;
use App\Http\Resources\Api\V1\User\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PersonalInformationController extends Controller
{
    public function __invoke(UpdatePersonalInformationRequest $request) : JsonResponse
    {
        $user = auth()->user();
        $user->address()->update($request->except('full_name', 'email', 'dob'));
        
        $user->update($request->only('full_name',' email', 'dob'));
        return response()->json(UserResource::make($user), Response::HTTP_OK);
    }
}
