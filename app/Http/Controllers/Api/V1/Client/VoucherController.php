<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\VoucherResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VoucherController extends Controller
{

    public function index()
    {
        $vouchers = auth()->user()->vouchers()->get();

        return response()->json(
            VoucherResource::collection($vouchers),
            Response::HTTP_OK
        );
    }


    public function show(int $resort)
    {
        $resort_vouchers = auth()->user()->vouchers()->where(['property_id' => $resort])->get();
        return response()->json(
            VoucherResource::collection($resort_vouchers),
            Response::HTTP_OK
        );
    }


    public function store(Request $request)
    {
        $request->validate([
            'voucher' => 'required|exists:vouchers,id'
        ]);

        $user_voucher = auth()->user()->vouchers();
        if (!$user_voucher->find($request->voucher)) {
            cache()->forget('vouchers-' . auth()->id());
            $user_voucher->attach($request->voucher);
            return response([
                'message' => 'Voucher Redeemed'
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Voucher Redeemed'
        ], Response::HTTP_ACCEPTED);
    }
}
