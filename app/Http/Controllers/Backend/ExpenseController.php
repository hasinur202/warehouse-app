<?php

namespace App\Http\Controllers\backend;

use Carbon\Carbon;
use App\Models\Expense;
use App\Models\Expense_head;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ExpenseController extends Controller
{

    public function index(){
        $expenses = Expense::all();
        $expense_heads = Expense_head::all();

        return view('layouts.backend.inventory.expense',[
            'expenses'=>$expenses,
            'expense_heads'=>$expense_heads
        ]);
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
            'expense_head_id'  =>  'required',
            'amount'  =>  'required',
            'date'  =>  'required',
        ]);

        $date = Carbon::parse($request->input('date'));

        Expense::create([
            'expense_head_id'=>$request->expense_head_id,
            'expense_name'=>$request->expense_name,
            'invoice_no'=>$request->invoice_no,
            'date'=>$date->format('Y-m-d'),
            'amount'=>$request->amount,
            'description'=>$request->description,
        ]);

        return response()->json([
            'message'=>'success'
        ],200);

    }




    public function expenseHeadStore(Request $request){
        $request->validate([
            'head_name'  =>  'required',
        ]);

        Expense_head::create([
            'head_name'=>$request->head_name,
        ]);

        return response()->json([
            'message'=>'success'
        ],200);

    }

    public function expenseHeadUpdate(Request $request){
        $request->validate([
            'head_name'  =>  'required',
        ]);

        $bb = Expense_head::where('id',$request->id)->update([
            'head_name'=>$request->head_name,
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
