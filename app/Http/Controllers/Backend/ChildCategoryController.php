<?php

namespace App\Http\Controllers\backend;

use App\Models\Warehouse;
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



    public function subCategoryById(Request $request){
        $data = Sub_category::where('main_category_id',$request->id)->where('status',1)->get();

        return response()->json([
            'message'=>'success',
            'data'=>$data
        ],200);
    }
}
