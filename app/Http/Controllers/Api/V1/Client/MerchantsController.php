<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Client\MerchantResource;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MerchantsController extends Controller
{

    public function __invoke(Request $request)
    {
        $merchants = Merchant::findMany($request->input('ids'));
        return response()->json(MerchantResource::collection($merchants), Response::HTTP_OK);
    }
}
