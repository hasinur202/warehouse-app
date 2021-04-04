<?php

namespace App\Http\Controllers\backend;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Shipping_class;

class ProductController extends Controller
{
    public function index(){

        $warehouses = Warehouse::where('status',1)->get();
        $brands = Brand::where('status',1)->get();
        $ships = Shipping_class::all();
        $colors = Color::where('status',1)->get();

        return view('layouts.backend.product.add_product',[
            'warehouses'=>$warehouses ?? '',
            'brands'=>$brands ?? '',
            'ships'=>$ships ?? '',
            'colors'=>$colors ?? '',
        ]);
    }

    public function product_list_index(){

        $warehouses = Warehouse::where('status',1)->get();

        return view('layouts.backend.product.product_list',[
            'warehouses'=>$warehouses ?? '',
        ]);
    }





}
