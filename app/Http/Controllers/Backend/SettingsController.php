<?php

namespace App\Http\Controllers\backend;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function index()
    {
        $data = auth()->user();
        $setting = Setting::first();

        return view('layouts.backend.settings.setup',[
            'data'=>$data,
            'setting'=>$setting,
        ]);
    }


    public function store(Request $request){
        $SettingId = Setting::select('id')->first();

        if($SettingId == null){
            $request->validate([
                'logo' => 'required',
                'title' =>'required',
                'contact' =>'required'
            ]);

            if($request->file('logo') != null){
                $logo = $request->file('logo');
                $new_name = rand() . '.' . $logo->getClientOriginalExtension();
                $upload_path = public_path()."/images/logo/";

                $data = Setting::create([
                    'title'=>$request->title,
                    'logo'=>$new_name,
                    'description'=>$request->description,
                    'email'=>$request->email,
                    'address'=>$request->address,
                    'contact'=>$request->contact,
                    'fb_link'=>$request->fb_link,
                    'twitt_link'=>$request->twitt_link,
                    'tube_link'=>$request->tube_link,
                    'insta_link'=>$request->insta_link
                ]);
                if($data){
                    $logo->move($upload_path, $new_name);
                }
            }else{
                Alert::error('Opps...','Data entry wrong.');
                return response()->json([
                    'message'=>'success'
                ],200);
            }

        }else{
            $setting = Setting::where('id',$request->id)->first();
            if($request->file('logo') != null){
                $logo = $request->file('logo');
                $new_name = rand() . '.' . $logo->getClientOriginalExtension();
                $upload_path = public_path()."/images/logo/";

                $d = public_path('images/logo/').$setting->logo;
                if(file_exists($d)){
                    @unlink($d);
                }
            }else{
                $new_name = $setting->logo;
            }

            $data = Setting::where('id',$request->id)->update([
                'logo'=>$new_name,
                'title'=>$request->title,
                'contact'=>$request->contact,
                'email'=>$request->email,
                'address'=>$request->address,
                'description'=>$request->description,
                'fb_link'=>$request->fb_link,
                'insta_link'=>$request->insta_link,
                'twitt_link'=>$request->twitt_link,
                'tube_link'=>$request->tube_link,
            ]);

            if($data){
                $logo->move($upload_path, $new_name);
            }

        }
        toast('Changes saved successfully','success')
                ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                return redirect()->back();
    }

}
