<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\How_to_buy;
use Illuminate\Http\Request;

class HowToBuyController extends Controller
{
    public function index(){
        $data = auth()->user();
        $buys = How_to_buy::first() ?? '';

        return view('layouts.backend.settings.how_to_buy',[
            'buys'=>$buys,
            'data'=>$data
        ]);
    }


    public function store(Request $request){
        request()->validate([
            'description' =>'required',
        ]);

        $confirmId = How_to_buy::select('id')->first();
        if($confirmId == null){
            $data = How_to_buy::create([
                'description'=>$request->description,
            ]);

        }else{
            How_to_buy::where('id',$request->id)->update([
                'description'=>$request->description,
            ]);
        }

        toast('Changes saved successfully','success')
        ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
        return redirect()->back();
    }
}
