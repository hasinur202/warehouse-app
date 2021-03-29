<?php

namespace App\Http\Controllers\backend;

use App\Models\Slide;
use App\Models\Warehouse;
use Illuminate\Support\Str;
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

    public function store(Request $request){
        $request->validate([
            'title'  =>  'required|unique:slides',
        ]);

        if ($request->file('image')) {
            $image = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $upload_path = public_path()."/images/slider/";

            $sll = Slide::create([
                'warehouse_id'=>$request->warehouse_id,
                'title'=>$request->title,
                'slug'=>Str::slug($request->title),
                'image'=>$new_name,
                'url'=>$request->url,
                'status'=>1
            ]);

            if($sll){
                $image->move($upload_path, $new_name);
            }

            return response()->json([
                'message'=>'success'
            ],200);
        }
    }





}
