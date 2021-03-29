<?php

namespace App\Http\Controllers\backend;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function index(){
        $brands = Brand::where('status',1)->get();

        return view('layouts.backend.brand.brand',[
            'brands'=>$brands,
        ]);
    }



    public function store(Request $request){
        $request->validate([
            'brand_name'  =>  'required|unique:brands',
        ]);

        if ($request->file('logo')) {
            $image = $request->file('logo');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $upload_path = public_path()."/images/brand/";

            $brand = Brand::create([
                'brand_name'=>$request->brand_name,
                'slug'=>Str::slug($request->brand_name),
                'logo'=>$new_name,
                'status'=>1
            ]);

            if($brand){
                $image->move($upload_path, $new_name);
            }

            return response()->json([
                'message'=>'success'
            ],200);
        }
    }








}
