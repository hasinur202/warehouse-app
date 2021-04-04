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


    public function store(Request $request){
        $request->validate([
            'state_name'  =>  'required',
        ]);

        District::create([
            'warehouse_id'=>$request->warehouse_id,
            'state_name'=>$request->state_name,
        ]);

        return response()->json([
            'message'=>'success'
        ],200);

    }


    // public function update(Request $request){
    //     $request->validate([
    //         'shipping_name'  =>  'required',
    //     ]);

    //     $bb = Shipping_class::where('id',$request->id)->update([
    //         'shipping_name'=>$request->shipping_name,
    //     ]);


    //     if($bb){
    //         toast('Created successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
    //             return redirect()->back();
    //     }else{
    //         Alert::warning('Opps...','Something went wrong!');
    //             return redirect()->back();
    //     }

    // }



}
