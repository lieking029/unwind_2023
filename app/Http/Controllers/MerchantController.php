<?php

namespace App\Http\Controllers;

use App\DataTables\MerchantDataTable;
use App\Http\Requests\StoreMerchantRequest;
use App\Http\Requests\UpdateMerchantRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MerchantDataTable $dataTable)
    {
        return $dataTable->render('admin.merchant.index', [
            'roles' => Role::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMerchantRequest $request)
    {
        User::create($request->except('password') + ['password' => Hash::make($request->password) ]);

        flash("Successfully created a new Merchant!", 'success');
        return redirect()->route('merchant.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMerchantRequest $request, User $user)
    {
        if(!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->update($request->except('password'));

        flash("Merchant's data saved successfully!", 'success');
        return redirect()->route('merchant.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        flash("You have successfully deleted a Merchant!", 'success');
        return redirect()->route('merchant.index');
    }
}
