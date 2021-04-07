<?php

namespace App\Http\Controllers\backend;

use Carbon\Carbon;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function index(){
        $coupons = Coupon::all();

        return view('layouts.backend.coupon.coupon',[
            'coupons'=>$coupons,
        ]);
    }


    public function store(Request $request){
        $request->validate([
            'coupon_name'  =>  'required|unique:coupons',
        ]);

        $start_date = Carbon::parse($request->input('start_date'));
        $end_date = Carbon::parse($request->input('end_date'));

        $data = Coupon::create([
            'coupon_name'=>$request->coupon_name,
            'start_date'=>$start_date->format('Y-m-d'),
            'end_date'=>$end_date->format('Y-m-d'),
            'min_price'=>$request->min_price,
            'discount_price'=>$request->discount_price,
            'discount_p'=>$request->discount_p,
            'apply_coupon'=>$request->apply_coupon
        ]);

        return response()->json([
            'message'=>'success'
        ],200);
    }
}
