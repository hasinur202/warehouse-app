<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index(){
        $colors = Color::all();

        return view('layouts.backend.color.color',[
            'colors'=>$colors,
        ]);
    }


    public function store(Request $request){
        $request->validate([
            'color_name'  =>  'required',
        ]);

        Color::create([
            'color_name'=>$request->color_name,
            'status'=>1
        ]);

        return response()->json([
            'message'=>'success'
        ],200);

    }







}
