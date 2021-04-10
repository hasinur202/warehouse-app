<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Expense_head;
use Illuminate\Http\Request;

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
}
