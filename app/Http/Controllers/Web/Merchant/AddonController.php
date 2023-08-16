<?php

namespace App\Http\Controllers\Web\Merchant;

use App\Models\Addon;
use Illuminate\Http\Request;
use App\DataTables\AddonDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Addon\StoreAddonRequest;

class AddonController extends Controller
{
    public function index(AddonDataTable $dataTable) {

        return $dataTable->render('merchant.addon.index');
    }

    public function store(StoreAddonRequest $request) {

        Addon::create($request->validated() + ['user_id' => auth()->id()]);

        return redirect()->back();
    }

    public function show(Addon $addon) {

        return response()->json($addon);
    }

    public function update(StoreAddonRequest $request, Addon $addon) {

        $addon->update($request->validated());

        alert()->success('Addon Updated Successfully');
        return redirect()->back();
    }

    public function destroy(Addon $addon) {

        $addon->delete();

        return redirect()->back();
    }
}
