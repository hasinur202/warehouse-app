<?php

namespace App\Http\Controllers\backend;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(){

        $warehouses = Warehouse::where('status',1)->get();

        return view('layouts.backend.product.add_product',[
            'warehouses'=>$warehouses ?? '',
        ]);
    }

    public function product_list_index(){

        $warehouses = Warehouse::where('status',1)->get();

        return view('layouts.backend.product.product_list',[
            'warehouses'=>$warehouses ?? '',
        ]);
    }





}
