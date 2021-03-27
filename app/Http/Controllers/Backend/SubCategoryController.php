<?php

namespace App\Http\Controllers\backend;

use App\Models\Warehouse;
use Illuminate\Support\Str;
use App\Models\Sub_category;
use Illuminate\Http\Request;
use App\Models\Main_category;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{

    public function index(){
        $warehouses = Warehouse::where('status',1)->get();

        $sub_cats = Sub_category::with('get_main_category','get_warehouse')->get();

        return view('layouts.backend.category.sub_category',[
            'sub_cats'=>$sub_cats,
            'warehouses'=>$warehouses ?? '',
        ]);
    }



    public function store(Request $request){
        $request->validate([
            'category_name'  =>  'required|unique:sub_categories',
        ]);

        if ($request->file('icon')) {
            $image = $request->file('icon');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $upload_path = public_path()."/images/sub_category/";

            $cat = Sub_category::create([
                'warehouse_id'=>$request->warehouse_id,
                'main_category_id'=>$request->main_cat_id,
                'category_name'=>$request->category_name,
                'slug'=>Str::slug($request->category_name),
                'icon'=>$new_name,
                'status'=>1
            ]);

            if($cat){
                $image->move($upload_path, $new_name);
            }

            return response()->json([
                'message'=>'success'
            ],200);
        }
    }

    public function mainCategoryByWarehouse(Request $request){
        $data = Main_category::where('warehouse_id',$request->id)->get();

        return response()->json([
            'message'=>'success',
            'data'=>$data
        ],200);

    }








}
