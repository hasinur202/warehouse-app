<?php

namespace App\Http\Controllers\backend;

use App\Models\Warehouse;
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
}
