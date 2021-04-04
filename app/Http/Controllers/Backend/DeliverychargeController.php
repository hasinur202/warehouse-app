<?php

namespace App\Http\Controllers\backend;

use App\Models\District;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\Shipping_class;
use App\Models\Delivery_charge;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class DeliverychargeController extends Controller
{
    public function index(){
        $warehouses = Warehouse::where('status',1)->get();
        $ships = Shipping_class::all();

        $charges = Delivery_charge::with('get_warehouse','get_shipping','get_district')->get();

        return view('layouts.backend.delivery-charge.delivery_charge',[
            'charges'=>$charges,
            'warehouses'=>$warehouses ?? '',
            'ships'=>$ships,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'warehouse_id' => 'required',
            'district_id' => 'required',
            'shipping_id' => 'required',
            'charge' => 'required',
        ]);

        for($i=0; $i<count($request->district_id); $i++){
            $arrayName = array('charge' => $request->charge);
            $all = array(
                'warehouse_id' => $request->warehouse_id,
                'district_id' => $request->district_id[$i],
                'shipping_id' => $request->shipping_id,
                'charge' => $request->charge,
            );

            $check = Delivery_charge::where('district_id',$request->district_id[$i])->where('warehouse_id',$request->warehouse_id)->where('shipping_id',$request->shipping_id)->first();

            if ($check){
                $update = Delivery_charge::where('district_id',$request->district_id[$i])->where('warehouse_id',$request->warehouse_id)->where('shipping_id',$request->shipping_id)->update($arrayName);
            }else{
                $insert = Delivery_charge::create($all);
            }
        }

        toast('Created successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
        return redirect()->back();

    }



    public function district_find(Request $request){

        $search = District::where('warehouse_id',$request->country_id)->get();
        foreach ($search as $data)
        {
          echo "<input type='checkbox' class='check_elmnt2' disabled='disabled' name='district_id[]' value=".$data->id.">&nbsp;".$data->state_name."&nbsp;&nbsp;";
        }

    }





}
