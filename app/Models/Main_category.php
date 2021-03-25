<?php

namespace App\Models;

use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Main_category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function get_warehouse()
    {
        return $this->belongsTo(Warehouse::class,'warehouse_id');
    }
}
