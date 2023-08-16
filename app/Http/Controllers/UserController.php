<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\UserTypeEnum;
use App\DataTables\UsersDataTable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\View\View;
use App\DataTables\SubHostDataTable;
use App\DataTables\MerchantDataTable;
use App\Http\Requests\StoreSubHostRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends Controller
{
    public function index(UsersDataTable $dataTable) : JsonResponse | View
    {
        return $dataTable->render('admin.users.index', [
            'roles' => Role::all()
        ]);
    }

    public function merchant(MerchantDataTable $dataTable) {
        return $dataTable->render('admin.users.index', [
            'roles' => Role::all()
        ]);
    }

    public function subHost(SubHostDataTable $dataTable) {
        return $dataTable->render('merchant.sub-host.index', [
            'roles' => Role::all()
        ]);
    }

    // public function storeSubHost(StoreSubHostRequest $request) {

    //     $subHost = User::create($request->validated() + ['merchant_id' => auth()->id()]);
    //     $subHost->assignRole(UserTypeEnum::SubHost);
    //     $subHost->save();

    //     return redirect()->back();
    // }

    // public function showSubHost($id) {
    //     $subHost = User::find($id);
    //     return response()->json($subHost);
    // }

    // public function updateSubHost(StoreSubHostRequest $request, $id) {
    //     $subHost = User::role(UserTypeEnum::SubHost)->with('roles')->find($id);

    //     DB::transaction(function() use($request, $subHost) {
    //         if(!empty($request->password)) {
    //             $subHost->password = $request->password;
    //         }

    //         $subHost->update($request->except('password', 'role'));

    //     });

    //     return redirect()->back();
    // }

    public function destroy(User $user) {

        $user->delete();

        return redirect()->back();
    }

}
