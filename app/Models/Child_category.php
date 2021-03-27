<?php

namespace App\Models;

use App\Models\Warehouse;
use App\Models\Sub_category;
use App\Models\Main_category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Child_category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function get_warehouse()
    {
        return $this->belongsTo(Warehouse::class,'warehouse_id');
    }

    public function get_main_category()
    {
        return $this->belongsTo(Main_category::class,'main_category_id');
    }

    public function get_sub_category()
    {
        return $this->belongsTo(Sub_category::class,'sub_category_id');
    }
}
