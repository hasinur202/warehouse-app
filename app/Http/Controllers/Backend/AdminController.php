<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function index(){
        $admins = User::where('type','admin')->get();

        return view('layouts.backend.admin-setup.admin_list',[
            'admins'=>$admins,
        ]);
    }

    public function createAdmin(Request $request){

        request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|unique:users',
        ]);

        if ($request->password == $request->confirm_password) {
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'type'=>'admin'
            ]);

            if($user){
                toast('Changes saved successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                return redirect()->back();
            }else{
                Alert::warning('Opps...','Something went wrong!');
            }

        }else{
            Alert::warning('Opps',"Password Miss-match");
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
