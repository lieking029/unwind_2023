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

    public function subHost(SubHostDataTable $dataTable) {
        return $dataTable->render('merchant.sub-host.index', [
            'roles' => Role::all()
        ]);
    }

    public function destroy(User $user) {

        $user->delete();

        return redirect()->back();
    }

}
