<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StorePropertyRequest;

class ResortController extends Controller
{
    public function index() : View {
        return view('merchant.resort.index');
    }

    public function create() : View
    {
        $types = PropertyType::all();
        return view('merchant.resort.create', compact('types'));
    }

    public function store(Request $request) : RedirectResponse {






        // creation done redirect to next
        // resort / location creation => redirect to subhost /room/bulk?resortId=1
        // rooms (room/{?resortId}) =
        // resort / location/ -> assign sub-host


        return redirect()->route('room.create', compact('report'));
    }
}
