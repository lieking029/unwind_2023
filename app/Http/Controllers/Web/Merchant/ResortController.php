<?php

namespace App\Http\Controllers\Web\Merchant;

use App\Http\Requests\Web\Resort\UpdateResortRequest;
use App\Models\TemporaryFiles;
use App\Models\User;
use App\Models\Addon;
use App\Models\Resort;
use App\Models\Amenity;
use Illuminate\View\View;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\DataTables\ResortDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Web\Resort\StoreResortRequest;

class ResortController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ResortDataTable $dataTable)
    {

        return $dataTable->render('merchant.resort.index');
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

        return view('merchant.resort.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreResortRequest $request): RedirectResponse
    {

        $resort = auth()->user()->resorts()->create(
            $request->except('featured_media', 'street_number', 'location_description', 'street_name', 'postal_code', 'barangay_district', 'subhost_id', 'amenities', 'addons')
        );

        $this->setResortMedia($request->featured_media, $resort);

        $resort->associatedUsers()->attach($request->input('subhost_id'));

        $resort->amenities()->attach($request->input('amenities'));

        $resort->addons()->attach($request->input('addons'));

        $resort->location()->create([
            'street_number' => $request->street_number,
            'description' => $request->location_description,
            'street_name' => $request->street_name,
            'postal_code' => $request->postal_code,
            'barangay_district' => $request->barangay_district
        ]);

        return redirect()->route('room.create', $resort->id);
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
    public function edit(Resort $resort)
    {
        $data['resort'] = $resort->with('address', 'addons', 'propertyType', 'amenities', 'associatedUsers')->first();
        $data['propertyTypes'] = PropertyType::all();
        $data['subHosts'] = User::where('merchant_id', auth()->id())->get();
        $data['amenities'] = Amenity::owned()->get();
        $data['addons'] = Addon::owned()->get();

        return view('merchant.resort.edit', compact('data', 'resort'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResortRequest $request, Resort $resort)
    {
        $resort->update($request->only('name', 'price', 'visibility', 'property_type_id', 'description'));

        $subhostId = $request->input('subhost_id');
        $resort->associatedUsers()->sync($subhostId);

        $resort->amenities()->sync($request->input('amenities'));

        $resort->address()->update($request->only('street_number', 'location_description', 'street_name', 'postal_code', 'barangay_district'));

        $resort->addons()->sync($request->input('addons'));

        return redirect()->route('resort.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resort $resort): RedirectResponse
    {
        $resort->delete();
        return redirect()->back();
    }

    /**
     *  Private function for featured_media upload
     */

    private function setResortMedia(?array $attachments, Resort $resort)
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
                    $resort->addMedia($filePath)->toMediaCollection('featured_media');
                    rmdir(storage_path('app/temporary/' . $file->folder));
                }
            } else {
                return redirect()->back();
            }
        }
    }

}
