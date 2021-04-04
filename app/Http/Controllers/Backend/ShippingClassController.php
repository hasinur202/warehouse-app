<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Shipping_class;
use Illuminate\Http\Request;

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




}
