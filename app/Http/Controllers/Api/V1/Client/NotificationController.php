<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Client\AdvertisementResource;
use App\Http\Resources\Api\Client\NotificationResource;
use App\Models\Advertisement;
use App\Models\Notification;

class NotificationController extends Controller
{

    public function index() {
        $notification = auth()->user()->notifications()
            ->with(['resort', 'voucher', 'media'])
            ->get();

        return response()->json(
            AdvertisementResource::collection($notification)
        );
    }


    public function delete(Advertisement $notification) {
        auth()->user()->notifications()->detach($notification->id);
        // $notification->delete();
        return response()->json(['message' => 'Notification Deleted']);
    }


    public function deleteAll() {
        auth()->user()->notifications()->detach();
        return response()->json(['message' => 'Notifications Deleted']);
    }
}
