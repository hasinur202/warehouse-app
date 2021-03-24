<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $data = auth()->user();

        return view('layouts.backend.admin-setup.create_admin',[
            'data'=>$data,
        ]);
    }
}
