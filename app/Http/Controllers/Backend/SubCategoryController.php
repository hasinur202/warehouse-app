<?php

namespace App\Http\Controllers\backend;

use App\Models\Warehouse;
use Illuminate\Support\Str;
use App\Models\Sub_category;
use Illuminate\Http\Request;
use App\Models\Main_category;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class SubCategoryController extends Controller
{

    public function index(){
        $warehouses = Warehouse::where('status',1)->get();

        $sub_cats = Sub_category::with(['get_main_category'=>function($q){
            $q->where('status',1);
        },'get_warehouse'=>function($q){
            $q->where('status',1);
        }])->get();

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

    public function update(Request $request){
        $data = Sub_category::where('id',$request->id)->first();
        if ($request->file('icon')) {
            $image = $request->file('icon');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $upload_path = public_path()."/images/sub_category/";
        }else{
            $new_name=$data->icon;
        }

        if($data->category_name == $request->category_name){
            $slugg = $request->category_name;
        }else{
            $checkslug = Sub_category::where('category_name',$request->category_name)->count();
            if($checkslug > 0){
                Alert::warning('Opps...','Category name should be unique!');
                return redirect()->back();
            }else{
                $slugg = $request->category_name;
            }
        }

        $cat = Sub_category::where('id',$request->id)->update([
            'warehouse_id'=>$request->warehouse_id,
            'main_category_id'=>$request->edit_main_cat_id,
            'category_name'=>$request->category_name,
            'icon'=>$new_name,
            'slug'=>Str::slug($slugg),
        ]);

        if ($request->file('icon') !=null ){
            $icon_d = public_path('images/sub_category/').$data->icon;
            if(file_exists($icon_d)){
                @unlink($icon_d);
            }
            $image->move($upload_path, $new_name);
        }
        if($cat){
            toast('Updated successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                return redirect()->back();
        }else{
            Alert::warning('Opps...','Something went wrong!');
                return redirect()->back();
        }

    }


    public function activity(Request $request){
        $data = Sub_category::where('id',$request->id)->first();

        if ($data->status == 0) {
            Sub_category::where('id',$request->id)->update([
                'status'=>1
            ]);

            return response()->json([
                'message'=>'success'
            ],200);
        }else{
            Sub_category::where('id',$request->id)->update([
                'status'=>0
            ]);

            return response()->json([
                'message'=>'success'
            ],200);
        }

    }





    public function mainCategoryByWarehouse(Request $request){
        $data = Main_category::where('warehouse_id',$request->id)->where('status',1)->get();

        return response()->json([
            'message'=>'success',
            'data'=>$data
        ],200);

    }








}
