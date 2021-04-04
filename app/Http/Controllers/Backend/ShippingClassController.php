<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\Shipping_class;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ShippingClassController extends Controller
{
    public function index(){
        $shipping_classes = Shipping_class::all();

        return view('layouts.backend.shipping-class.shipping_class',[
            'shipping_classes'=>$shipping_classes,
        ]);
    }


    public function store(Request $request){
        $request->validate([
            'shipping_name'  =>  'required',
        ]);

        Shipping_class::create([
            'shipping_name'=>$request->shipping_name,
        ]);

        return response()->json([
            'message'=>'success'
        ],200);

    }


    public function update(Request $request){
        $request->validate([
            'shipping_name'  =>  'required',
        ]);

        $bb = Shipping_class::where('id',$request->id)->update([
            'shipping_name'=>$request->shipping_name,
        ]);


        if($bb){
            toast('Updated successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                return redirect()->back();
        }else{
            Alert::warning('Opps...','Something went wrong!');
                return redirect()->back();
        }

    }




}
