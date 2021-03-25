<?php

namespace App\Http\Controllers\Backend;

use App\Models\Warehouse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Main_category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(){
        $warehouses = Warehouse::where('status',1)->get();

        $main_cats = Main_category::get();

        return view('layouts.backend.category.main_category',[
            'main_cats'=>$main_cats,
            'warehouses'=>$warehouses ?? '',
        ]);
    }


    public function storeMainCategory(Request $request){
        $request->validate([
            'category_name'  =>  'required|unique:main_categories',
        ]);

        if ($request->file('icon')) {
            $image = $request->file('icon');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $upload_path = public_path()."/images/main_category/";

            $cat = Main_category::create([
                'warehouse_id'=>$request->warehouse_id,
                'admin_id'=>auth()->user()->id,
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




}
