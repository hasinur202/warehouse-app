<?php

namespace App\Http\Controllers\backend;

use App\Models\Warehouse;
use Illuminate\Support\Str;
use App\Models\Sub_category;
use Illuminate\Http\Request;
use App\Models\Child_category;
use App\Http\Controllers\Controller;

class ChildCategoryController extends Controller
{
    public function index(){
        $warehouses = Warehouse::where('status',1)->get();

        $child_cats = Child_category::with(['get_main_category'=>function($q){
            $q->where('status',1);
        },'get_sub_category'=>function($q){
            $q->where('status',1);
        },'get_warehouse'=>function($q){
            $q->where('status',1);
        }])->get();

        return view('layouts.backend.category.child_category',[
            'child_cats'=>$child_cats,
            'warehouses'=>$warehouses ?? '',
        ]);
    }


    public function store(Request $request){
        $request->validate([
            'category_name'  =>  'required|unique:child_categories',
        ]);

        if ($request->file('icon')) {
            $image = $request->file('icon');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $upload_path = public_path()."/images/child_category/";

            $cat = Child_category::create([
                'warehouse_id'=>$request->warehouse_id,
                'main_category_id'=>$request->main_cat_id,
                'sub_category_id'=>$request->sub_cat_id,
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



    public function subCategoryById(Request $request){
        $data = Sub_category::where('main_category_id',$request->id)->where('status',1)->get();

        return response()->json([
            'message'=>'success',
            'data'=>$data
        ],200);
    }
}
