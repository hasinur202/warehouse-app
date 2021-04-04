<?php

namespace App\Http\Controllers\backend;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

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


    public function update(Request $request){
        $request->validate([
            'color_name'  =>  'required',
        ]);

        $bb = Color::where('id',$request->id)->update([
            'color_name'=>$request->color_name,
        ]);


        if($bb){
            toast('Created successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                return redirect()->back();
        }else{
            Alert::warning('Opps...','Something went wrong!');
                return redirect()->back();
        }

    }







}
