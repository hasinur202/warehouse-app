<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Privacypolicy;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PrivacypolicyController extends Controller
{
    public function index(){
        $data = auth()->user();
        $privacy = Privacypolicy::first() ?? '';

        return view('layouts.backend.privacy-policy.privacy_policy',[
            'privacy'=>$privacy,
            'data'=>$data
        ]);
    }


    public function store(Request $request){
        request()->validate([
            'description' =>'required',
        ]);

        $confirmId = Privacypolicy::select('id')->first();
        if($confirmId == null){
            $data = Privacypolicy::create([
                'description'=>$request->description,
            ]);

        }else{
            Privacypolicy::where('id',$request->id)->update([
                'description'=>$request->description,
            ]);
        }

        toast('Changes saved successfully','success')
        ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
        return redirect()->back();
    }
}
