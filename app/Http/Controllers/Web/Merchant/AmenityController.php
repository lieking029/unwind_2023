<?php

namespace App\Http\Controllers\Web\Merchant;

use App\Models\Amenity;
use Illuminate\Http\Request;
use App\DataTables\AmenityDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Amenity\StoreAmenityRequest;

class AmenityController extends Controller
{
    public function index(AmenityDataTable $dataTable) {
        return $dataTable->render('merchant.amenity.index');
    }

    public function store(StoreAmenityRequest $request) {
        Amenity::create($request->validated() + ['user_id' => auth()->id()]);

        return redirect()->back();
    }

    public function show(Amenity $amenity) {
        return response()->json($amenity);
    }

    public function update(StoreAmenityRequest $request, Amenity $amenity) {
        $amenity->update($request->validated());

        alert()->success('Amenity Updated Successfully');
        return redirect()->back();
    }

    public function destroy(Amenity $amenity) {
        $amenity->delete();

        return redirect()->back();
    }
}
