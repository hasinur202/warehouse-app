<?php

namespace App\Http\Controllers\backend;

use App\Models\Slide;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    public function index(){

        $warehouses = Warehouse::where('status',1)->get();
        $slides = Slide::with('get_warehouse')->get();

        return view('layouts.backend.slider.slider',[
            'slides'=>$slides,
            'warehouses'=>$warehouses ?? '',
        ]);
    }
}
