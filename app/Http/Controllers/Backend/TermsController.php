<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Terms_condition;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function index(){
        $data = auth()->user();
        $terms = Terms_condition::first() ?? '';

        return view('layouts.backend.terms-condition.terms_condition',[
            'terms'=>$terms,
            'data'=>$data
        ]);
    }


    public function store(Request $request){
        request()->validate([
            'description' =>'required',
        ]);

        $confirmId = Terms_condition::select('id')->first();
        if($confirmId == null){
            $data = Terms_condition::create([
                'description'=>$request->description,
            ]);

        }else{
            Terms_condition::where('id',$request->id)->update([
                'description'=>$request->description,
            ]);
        }

        toast('Changes saved successfully','success')
        ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
        return redirect()->back();
    }
}
