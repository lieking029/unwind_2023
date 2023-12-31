<?php

namespace App\Http\Controllers\Api\V1\Client\Settings;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Shared\UpdateAvatarRequest;
use App\Http\Resources\Api\V1\User\UserResource;

class UploadProfileController extends Controller
{
    public function __invoke(UpdateAvatarRequest $request) {
       $avatarPath = 'storage/'. $request->file('avatar')->store('avatars', 'public');
       
       auth()->user()->update(['avatar' => $avatarPath]);
       return response()->json(UserResource::make(auth()->user()), Response::HTTP_ACCEPTED);
   }
}
 
