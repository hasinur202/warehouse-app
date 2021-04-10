<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(){
        $data = auth()->user();
        $faq = Faq::first() ?? '';

        return view('layouts.backend.faq.faq',[
            'faq'=>$faq,
            'data'=>$data
        ]);
    }


    public function store(Request $request){
        request()->validate([
            'description' =>'required',
        ]);

        $confirmId = Faq::select('id')->first();
        if($confirmId == null){
            $data = Faq::create([
                'description'=>$request->description,
            ]);

        }else{
            Faq::where('id',$request->id)->update([
                'description'=>$request->description,
            ]);
        }

        toast('Changes saved successfully','success')
        ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
        return redirect()->back();
    }
}
