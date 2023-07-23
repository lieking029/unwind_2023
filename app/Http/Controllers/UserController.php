<?php

namespace App\Http\Controllers;

use App\DataTables\MerchantDataTable;
use App\DataTables\SubHostDataTable;
use App\Http\Requests\StoreSubHostRequest;
use App\Models\User;
use App\Enums\UserTypeEnum;
use App\DataTables\UsersDataTable;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends Controller
{
    public function index(UsersDataTable $dataTable) : JsonResponse | View
    {
        // $users = User::role(UserTypeEnum::Client)->with('roles')->paginate();

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

    public function storeSubHost(StoreSubHostRequest $request) {

        $subHost = User::create($request->validated() + ['merchant_id' => auth()->id()]);
        $subHost->assignRole(UserTypeEnum::SubHost);
        $subHost->save();

        return redirect()->back();
    }

    public function showSubHost($id) {
        $subHost = User::find($id);
        return response()->json($subHost);
    }
}
