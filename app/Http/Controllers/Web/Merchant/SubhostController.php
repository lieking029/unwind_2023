<?php

namespace App\Http\Controllers\Web\Merchant;

use App\Models\User;
use Illuminate\View\View;
use App\Enums\UserTypeEnum;
use Illuminate\Http\JsonResponse;
use App\DataTables\SubHostDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Web\User\StoreSubHostRequest;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class SubhostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubHostDataTable $dataTable) : View | JsonResponse | BinaryFileResponse
    {
        ob_end_clean();
        return $dataTable->render('merchant.sub-host.index');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubHostRequest $request) : RedirectResponse
    {
        User::create($request->validated() + ['merchant_id' => auth()->id()])
            ->assignRole(UserTypeEnum::SubHost);

        return redirect()->route('subhost.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json($user);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSubHostRequest $request, User $user) : RedirectResponse
    {
        if (!empty($request->password)) {
            $user->password = $request->password;
        }

        $user->update($request->except('password'));

        return redirect()->route('subhost.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user) : RedirectResponse
    {
        $user->delete();

        return redirect()->route('merchant.subhost.index');
    }
}
