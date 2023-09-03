<?php

namespace App\Http\Controllers\Web\Merchant;

use App\Http\Requests\Web\Room\UpdateRoomRequest;
use App\Models\Property;
use App\Models\Room;
use App\Models\Resort;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Room\StoreRoomRequest;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        return view('merchant.room.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request, Property $property)
    {
        $rooms = [];

        foreach ($request->rooms as $room) {
            $imagePath = null; // Define imagePath with a default value

            $rooms[] = [
                'property_id' => $property->id,
                'max_guest_count' => $room['max_guest_count'],
                'bed_count' => $room['bed_count'],
                'bath_count' => $room['bath_count'],
                'price' => $room['price'],
                'room_media' => $room['room_media']->store('rooms', 'public'),
            ];
        }

        $property->rooms()->insert($rooms);
        return redirect()->route('property.index');
    }


    /**
     * Display the specified resource.
     */
    // public function show(Room $room)
    // {

    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        $data['resort'] = $property->with('rooms')->first();

        return view('merchant.room.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, Property $property)
    {
        $existingRoomIds = $property->rooms->pluck('id')->toArray();

        foreach ($request->input('rooms', []) as $roomData) {
            $roomId = $roomData['id'] ?? null;

            if ($roomId && in_array($roomId, $existingRoomIds)) {
                $room = Room::find($roomId);
                $room->update([
                    'max_guest_count' => $roomData['max_guest_count'],
                    'bath_count' => $roomData['bath_count'],
                    'bed_count' => $roomData['bed_count'],
                    'price' => $roomData['price'],
                ]);

                $existingRoomIds = array_diff($existingRoomIds, [$roomId]);
            } else {
                $room = new Room([
                    'max_guest_count' => $roomData['max_guest_count'],
                    'bath_count' => $roomData['bath_count'],
                    'bed_count' => $roomData['bed_count'],
                    'price' => $roomData['price'],
                ]);

                $property->rooms()->save($room);
            }
        }
        Room::whereIn('id', $existingRoomIds)->delete();

        return redirect()->route('property.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->back();
    }
}
