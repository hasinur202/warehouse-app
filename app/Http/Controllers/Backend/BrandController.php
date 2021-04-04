<?php

namespace App\Http\Controllers\backend;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class BrandController extends Controller
{
    public function index(){
        $brands = Brand::all();

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

    public function update(Request $request){
        $data = Brand::where('id',$request->id)->first();
        if ($request->file('logo')) {
            $image = $request->file('logo');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $upload_path = public_path()."/images/brand/";
        }else{
            $new_name=$data->logo;
        }

        if($data->brand_name == $request->brand_name){
            $slugg = $request->brand_name;
        }else{
            $checkslug = Brand::where('brand_name',$request->brand_name)->count();
            if($checkslug > 0){
                Alert::warning('Opps...','Brand name should be unique!');
                return redirect()->back();
            }else{
                $slugg = $request->brand_name;
            }
        }

        $bb = Brand::where('id',$request->id)->update([
            'brand_name'=>$request->brand_name,
            'logo'=>$new_name,
            'slug'=>Str::slug($slugg),
        ]);

        if ($request->file('logo') !=null ){
            $icon_d = public_path('images/brand/').$data->logo;
            if(file_exists($icon_d)){
                @unlink($icon_d);
            }
            $image->move($upload_path, $new_name);
        }
        if($bb){
            toast('Updated successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                return redirect()->back();
        }else{
            Alert::warning('Opps...','Something went wrong!');
                return redirect()->back();
        }

    }




    public function activity(Request $request){
        $data = Brand::where('id',$request->id)->first();

        if ($data->status == 0) {
            Brand::where('id',$request->id)->update([
                'status'=>1
            ]);

            return response()->json([
                'message'=>'success'
            ],200);
        }else{
            Brand::where('id',$request->id)->update([
                'status'=>0
            ]);

            return response()->json([
                'message'=>'success'
            ],200);
        }

    }









}
