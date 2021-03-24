<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(){
        $admins = User::where('type','super_admin')->where('status',1)->orWhere('type','admin')->get();

        return view('layouts.backend.admin-setup.admin_list',[
            'admins'=>$admins,
        ]);
    }
}
