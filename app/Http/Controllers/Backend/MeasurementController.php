<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\Measurement_type;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

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


    public function update(Request $request){
        $request->validate([
            'measurement_type'  =>  'required',
        ]);

        $bb = Measurement_type::where('id',$request->id)->update([
            'measurement_type'=>$request->measurement_type,
        ]);


        if($bb){
            toast('Updated successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                return redirect()->back();
        }else{
            Alert::warning('Opps...','Something went wrong!');
                return redirect()->back();
        }

    }
}
