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
            toast('Updated successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                return redirect()->back();
        }else{
            Alert::warning('Opps...','Something went wrong!');
                return redirect()->back();
        }

    }


    public function activity(Request $request){
        $data = Color::where('id',$request->id)->first();

        if ($data->status == 0) {
            Color::where('id',$request->id)->update([
                'status'=>1
            ]);

            return response()->json([
                'message'=>'success'
            ],200);
        }else{
            Color::where('id',$request->id)->update([
                'status'=>0
            ]);

            return response()->json([
                'message'=>'success'
            ],200);
        }

    }







}
