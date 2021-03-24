<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(){
        $admins = User::where('type','admin')->get();

        return view('layouts.backend.admin-setup.admin_list',[
            'admins'=>$admins,
        ]);
    }

    public function createAdmin(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|unique:users',
            'type'=>'admin'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors'=>"match"
            ],500);

        }else{
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'msg'=>'succes'
            ],200);
        }
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
