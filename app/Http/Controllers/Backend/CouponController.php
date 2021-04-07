<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index(){
        $coupons = Coupon::all();

        return view('layouts.backend.coupon.coupon',[
            'coupons'=>$coupons,
        ]);
    }
}
