<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Warehouse;
use App\Models\Sub_category;
use App\Models\Main_category;
use App\Models\Product_image;
use App\Models\Child_category;
use App\Models\Shipping_class;
use App\Models\Measurement_type;
use App\Models\Product_attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'color_products')->withTimestamps();
    }

    public function get_warehouse(){
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }
    public function main_category(){
        return $this->belongsTo(Main_category::class, 'main_category_id');
    }

    public function sub_category(){
        return $this->belongsTo(Sub_category::class, 'sub_category_id');
    }
    
    public function child_category(){
        return $this->belongsTo(Child_category::class, 'child_category_id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    
    public function shipping_class(){
        return $this->belongsTo(Shipping_class::class, 'shipping_id');
    }

    public function measurement(){
        return $this->belongsTo(Measurement_type::class, 'measurement_id');
    }

    public function product_images(){
        return $this->hasMany(Product_image::class, 'product_id');
    }

    public function attributes(){
        return $this->hasMany(Product_attribute::class, 'product_id');
    }

}
