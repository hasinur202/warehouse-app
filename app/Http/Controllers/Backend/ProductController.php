<?php

namespace App\Http\Controllers\backend;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;

class ProductController extends Controller
{
    public function index(){

        $warehouses = Warehouse::where('status',1)->get();
        $brands = Brand::where('status',1)->get();

        return view('layouts.backend.product.add_product',[
            'warehouses'=>$warehouses ?? '',
            'brands'=>$brands ?? '',
        ]);
    }

    public function product_list_index(){

        $warehouses = Warehouse::where('status',1)->get();

        return view('layouts.backend.product.product_list',[
            'warehouses'=>$warehouses ?? '',
        ]);
    }





}
