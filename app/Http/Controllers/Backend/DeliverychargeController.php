<?php

namespace App\Http\Controllers\backend;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\District;

class DeliverychargeController extends Controller
{
    public function index(){
        $warehouses = Warehouse::where('status',1)->get();

        // $main_cats = Main_category::with('get_warehouse')->get();

        return view('layouts.backend.delivery-charge.delivery_charge',[
            // 'main_cats'=>$main_cats,
            'warehouses'=>$warehouses ?? '',
        ]);
    }



    public function district_find(Request $request){

        $search = District::where('country_id',$request->country_id)->get();
        foreach ($search as $data)
        {
          echo "<input type='checkbox' class='check_elmnt2' disabled='disabled' name='district_id[]' value=".$data->id.">&nbsp;".$data->district_name."&nbsp;&nbsp;";
        }

    }





}
