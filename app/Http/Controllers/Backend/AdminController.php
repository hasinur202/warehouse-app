<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(){
        $admins = User::where('type','admin')->get();

        return view('layouts.backend.admin-setup.admin_list',[
            'admins'=>$admins,
        ]);
    }


    public function adminActivity(Request $request){
        $data = User::where('id',$request->id)->first();

        if ($data->status == 0) {
            User::where('id',$request->id)->update([
                'status'=>1
            ]);

            return response()->json([
                'message'=>'success'
            ],200);
        }else{
            User::where('id',$request->id)->update([
                'status'=>0
            ]);

            return response()->json([
                'message'=>'success'
            ],200);
        }

    }







}
