<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Main_category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $main_cats = Main_category::get();

        return view('layouts.backend.category.main_category',[
            'main_cats'=>$main_cats,
        ]);
    }
}
