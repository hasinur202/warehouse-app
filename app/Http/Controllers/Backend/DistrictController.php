<?php

namespace App\Http\Controllers\backend;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\District;

class DistrictController extends Controller
{
    public function index(){
        $warehouses = Warehouse::where('status',1)->get();

        $districts = District::with('get_warehouse')->get();

        return view('layouts.backend.district.district',[
            'districts'=>$districts,
            'warehouses'=>$warehouses ?? '',
        ]);
    }



}
