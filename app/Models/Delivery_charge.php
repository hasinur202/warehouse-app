<?php

namespace App\Models;

use App\Models\District;
use App\Models\Warehouse;
use App\Models\Shipping_class;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Delivery_charge extends Model
{
    use HasFactory;

    protected $guarded = [];



    public function get_warehouse()
    {
        return $this->belongsTo(Warehouse::class,'warehouse_id');
    }

    public function get_district()
    {
        return $this->belongsTo(District::class,'district_id');
    }

    public function get_shipping()
    {
        return $this->belongsTo(Shipping_class::class,'shipping_id');
    }


}
