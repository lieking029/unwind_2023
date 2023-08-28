<?php

namespace App\Http\Controllers\Web\Merchant;

use App\DataTables\PropertyDataTable;
use App\Http\Requests\Web\Resort\StorePropertyRequest;
use App\Http\Requests\Web\Resort\UpdatePropertyRequest;
use App\Models\Barangay;
use App\Models\City;
use App\Models\Property;
use App\Models\Province;
use App\Models\Region;
use App\Models\TemporaryFiles;
use App\Models\User;
use App\Models\Addon;
use App\Models\Amenity;
use Illuminate\View\View;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PropertyDataTable $dataTable)
    {

        return $dataTable->render('merchant.property.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $data['propertyTypes'] = PropertyType::all();
        $data['subHosts'] = User::where('merchant_id', auth()->id())->get();
        $data['amenities'] = Amenity::owned()->get();
        $data['addons'] = Addon::owned()->get();
        $data['regions'] = Region::all();

        return view('merchant.property.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyRequest $request): RedirectResponse
    {

        $property = auth()->user()->properties()->create(
            $request->except('featured_media', 'street_number', 'location_description', 'street_name', 'postal_code', 'barangay_district', 'subhost_id', 'amenities', 'addons')
        );

        $this->setPropertyMedia($request->featured_media, $property);

        $property->associatedUsers()->attach($request->input('subhost_id'));

        $property->amenities()->attach($request->input('amenities'));

        $property->addons()->attach($request->input('addons'));

        $property->location()->create([
            'street_number' => $request->street_number,
            'landmark' => $request->landmark,
            'street_name' => $request->street_name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'region_id' => $request->region_id,
            'barangay_id' => $request->barangay_id,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
        ]);

        return redirect()->route('room.create', $property->id);
    }

    /**
     * Display the specified resource.
     */
    //     public function show(Resort $resort)
//     {

    //     }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        $data['property'] = $property->with('location', 'addons', 'propertyType', 'amenities', 'associatedUsers')->first();
        $data['propertyTypes'] = PropertyType::all();
        $data['subHosts'] = User::where('merchant_id', auth()->id())->get();
        $data['amenities'] = Amenity::owned()->get();
        $data['addons'] = Addon::owned()->get();

        return view('merchant.property.edit', compact('data', 'property'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyRequest $request, Property $property)
    {
        $property->update($request->only('name', 'price', 'visibility', 'property_type_id', 'description'));

        $subhostId = $request->input('subhost_id');
        $property->associatedUsers()->sync($subhostId);

        $property->amenities()->sync($request->input('amenities'));

        $property->address()->update($request->only('street_number', 'location_description', 'street_name', 'postal_code', 'barangay_district'));

        $property->addons()->sync($request->input('addons'));

        return redirect()->route('property.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property): RedirectResponse
    {
        $property->delete();
        return redirect()->back();
    }

    /**
     *  Private function for featured_media upload
     */

    private function setPropertyMedia(?array $attachments, Property $property)
    {
        if ($attachments == null) {
            return;
        }

        foreach ($attachments as $attachment) {
            // Remove any additional quotes around the attachment string
            $attachment = trim($attachment, '"');

            $file = TemporaryFiles::where('folder', $attachment)->first();
            if ($file) {
                $filePath = storage_path('app/temporary/' . $file->folder . '/' . $file->file_name);

                if (file_exists($filePath)) {
                    $property->addMedia($filePath)->toMediaCollection('featured_media');
                    rmdir(storage_path('app/temporary/' . $file->folder));
                }
            } else {
                return redirect()->back();
            }
        }
    }

}
