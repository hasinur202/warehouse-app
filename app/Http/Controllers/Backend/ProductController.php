<?php

namespace App\Http\Controllers\backend;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(){

        $warehouses = Warehouse::where('status',1)->get();

        return view('layouts.backend.product.product',[
            'warehouses'=>$warehouses ?? '',
        ]);
    }





}
