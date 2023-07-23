<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\UserTypeEnum;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $clients = User::role(UserTypeEnum::Client)->with('roles')->count();

        $merchants = User::role(UserTypeEnum::Merchant)->with('roles')->count();

        return view('home', compact('clients', 'merchants'));
    }
}
