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




}
