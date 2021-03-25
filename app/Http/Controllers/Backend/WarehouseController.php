<?php

namespace App\Http\Controllers\Backend;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class WarehouseController extends Controller
{
    public function index(){
        $warehouses = Warehouse::get();

        return view('layouts.backend.warehouse.warehouse',[
            'warehouses'=>$warehouses,
        ]);
    }

    public function store(Request $request){
        request()->validate([
            'warehouse_name' => 'required|unique:warehouses',
        ]);
        $ware = Warehouse::create([
            'warehouse_name' => $request->warehouse_name,
            'status' => $request->status,
        ]);

        if($ware){
            toast('Changes saved successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
            return redirect()->back();
        }else{
            Alert::warning('Opps...','Something went wrong!');
            return redirect()->back();
        }
    }
}
