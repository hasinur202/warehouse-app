<?php

namespace App\Http\Controllers\backend;

use App\Models\Expense_head;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ExpenseController extends Controller
{

    public function index(){

    }




    public function expenseHeadIndex(){
        $expenses = Expense_head::all();

        return view('layouts.backend.inventory.expense_head',[
            'expenses'=>$expenses,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'expense_name'  =>  'required',
        ]);

        Expense_head::create([
            'expense_name'=>$request->expense_name,
        ]);

        return response()->json([
            'message'=>'success'
        ],200);

    }

    public function update(Request $request){
        $request->validate([
            'expense_name'  =>  'required',
        ]);

        $bb = Expense_head::where('id',$request->id)->update([
            'expense_name'=>$request->expense_name,
        ]);


        if($bb){
            toast('Updated successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                return redirect()->back();
        }else{
            Alert::warning('Opps...','Something went wrong!');
                return redirect()->back();
        }

    }




}
