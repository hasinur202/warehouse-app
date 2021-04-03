<?php

namespace App\Http\Controllers\backend;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class AboutController extends Controller
{
    public function index(){
        $data = auth()->user();
        $about = About::first() ?? '';

        return view('layouts.backend.about.about',[
            'about'=>$about,
            'data'=>$data
        ]);
    }


    public function store(Request $request){
        request()->validate([
            'description' =>'required',
        ]);

        $confirmId = About::select('id')->first();
        if($confirmId == null){
            $data = About::create([
                'description'=>$request->description,
            ]);

        }else{
            About::where('id',$request->id)->update([
                'description'=>$request->description,
            ]);
        }

        toast('Changes saved successfully','success')
        ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
        return redirect()->back();
    }
}
