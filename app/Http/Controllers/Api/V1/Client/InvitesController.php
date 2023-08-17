<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Client\InvitesResource;
use App\Models\Invite;
use Illuminate\Http\Request;

class InvitesController extends Controller
{
    
    public function __invoke()
    {
        $invites = Invite::query()
            ->with(['user'])
            ->where(['referrer_id' => auth()->id()])->get();

        return response()->json(InvitesResource::collection($invites));
    }
}
