<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Measurement_type;
use Illuminate\Http\Request;

class MeasurementController extends Controller
{
    public function index(){

        $measurements = Measurement_type::all();

        return view('layouts.backend.measurement.measurement',[
            'measurements'=>$measurements,
        ]);
    }


    public function store(Request $request){
        $request->validate([
            'measurement_name'  =>  'required',
        ]);

        Measurement_type::create([
            'measurement_type'=>$request->measurement_name,
        ]);

        return response()->json([
            'message'=>'success'
        ],200);

    }


    // public function update(Request $request){
    //     $request->validate([
    //         'color_name'  =>  'required',
    //     ]);

    //     $bb = Color::where('id',$request->id)->update([
    //         'color_name'=>$request->color_name,
    //     ]);


    //     if($bb){
    //         toast('Updated successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
    //             return redirect()->back();
    //     }else{
    //         Alert::warning('Opps...','Something went wrong!');
    //             return redirect()->back();
    //     }

    // }
}
