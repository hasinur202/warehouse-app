<?php

namespace App\Http\Controllers\backend;

use ArrayIterator;
use App\Models\Brand;
use App\Models\Color;
use MultipleIterator;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\Product_image;
use App\Models\Shipping_class;
use App\Models\Measurement_type;
use App\Models\Product_attribute;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(){
        $warehouses = Warehouse::where('status',1)->get();
        $brands = Brand::where('status',1)->get();
        $ships = Shipping_class::all();
        $colors = Color::where('status',1)->get();
        $measurements = Measurement_type::all();

        return view('layouts.backend.product.add_product',[
            'warehouses'=>$warehouses ?? '',
            'brands'=>$brands ?? '',
            'ships'=>$ships ?? '',
            'colors'=>$colors ?? '',
            'measurements'=>$measurements ?? ''
        ]);
    }

    public function product_list_index(){
        $warehouses = Warehouse::where('status',1)->get();

        return view('layouts.backend.product.product_list',[
            'warehouses'=>$warehouses ?? '',
        ]);
    }


    public function store(Request $request){
       
      
        // $pro = new Product();
        //     $pro->warehouse_id      = $request->warehouse_id;
        //     $pro->brand_id          = $request->brand;
        //     $pro->main_category_id  = $request->main_category;
        //     $pro->sub_category_id   = $request->sub_category;
        //     $pro->child_category_id = $request->child_category;
        //     $pro->shipping_id       = $request->shipp_class;
        //     $pro->product_name      = $request->product_name;
        //     $pro->product_barcode   = $request->product_barcode;
        //     $pro->product_sku       = $request->product_sku;
        //     $pro->product_type      = $request->product_type;
        //     $pro->shipp_duration    = $request->shipp_duration;
        //     $pro->condition         = $request->condition;
        //     $pro->description       = $request->description;
        //     $pro->feature_image       = $request->image;
        //     $pro->save();
        //     $pro->colors()->sync($request->product_color);

        //     foreach($request->gallery as $img){
        //         Product_image::create([
        //             'product_id'=>$pro->id,
        //             'gallery_img'=>$img
        //         ]);
        //     }

        //     for($i=0; $i < count($request->qty); $i++){
        //         $all = array(
        //             'product_id' => $pro->id,
        //             'size' => $request->size[$i],
        //             'qty' => $request->qty[$i],
        //             'purchase_price' => $request->purchase_price[$i],
        //             'sale_price' => $request->sale_price[$i],
        //             'discount' => $request->discount[$i],
        //             'discount_p' => $request->discount_p[$i],
        //             'current_price' => $request->c_price[$i],
        //         );
        //         $insert = Product_attribute::create($all);
        //     }

        return "Successfully inserted";
    }










}
