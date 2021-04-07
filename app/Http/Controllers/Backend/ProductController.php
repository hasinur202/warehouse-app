<?php

namespace App\Http\Controllers\backend;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Support\Str;
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
        $products = Product::with(['get_warehouse','main_category','sub_category','child_category','brand','attributes','shipping_class'])->get();

        $brands = Brand::where('status',1)->get();
        $ships = Shipping_class::all();
        $colors = Color::where('status',1)->get();
        $measurements = Measurement_type::all();

        return view('layouts.backend.product.product_list',[
            'warehouses'=>$warehouses ?? '',
            'products'=>$products,
            'brands'=>$brands ?? '',
            'ships'=>$ships ?? '',
            'colors'=>$colors ?? '',
            'measurements'=>$measurements ?? ''
        ]);
    }


    public function store(Request $request){
        $request->validate([
            'product_name'  =>  'required|unique:products',
            'product_barcode'  =>  'required|unique:products',
            'product_sku'  =>  'required|unique:products',
        ]);

        if ($request->file('image')) {
            $image = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $upload_path = public_path()."/images/product/";

            $pro = new Product();
            $pro->warehouse_id      = $request->warehouse_id;
            $pro->brand_id          = $request->brand;
            $pro->main_category_id  = $request->main_category;
            $pro->sub_category_id   = $request->sub_category;
            $pro->child_category_id = $request->child_category;
            $pro->shipping_id       = $request->shipp_class;
            $pro->measurement_id    = $request->measurement;
            $pro->product_name      = $request->product_name;
            $pro->slug              = Str::slug($request->product_name);
            $pro->product_barcode   = $request->product_barcode;
            $pro->product_sku       = $request->product_sku;
            $pro->product_type      = $request->product_type;
            $pro->shipp_duration    = $request->shipp_duration;
            $pro->condition         = $request->condition;
            $pro->description       = $request->description;
            $pro->feature_image     = $new_name;
            $pro->save();

            $pro->colors()->sync($request->product_color);
            $image->move($upload_path, $new_name);
        }
        //upload multiple images
        if($files=$request->file('gallery')){
            foreach($files as $img){
                $name = rand() . '.' . $img->getClientOriginalExtension();
                $upload_path = public_path()."/images/product/";
    
                Product_image::create([
                    'product_id'=>$pro->id,
                    'gallery_img'=>$name
                ]);

                $img->move($upload_path, $name);
            }
        }
        //insert product attributes
        for($i=0; $i < count($request->qty); $i++){
            $all = array(
                'product_id' => $pro->id,
                'size' => $request->size[$i],
                'qty' => $request->qty[$i],
                'purchase_price' => $request->purchase_price[$i],
                'sale_price' => $request->sale_price[$i],
                'discount' => $request->discount[$i],
                'discount_p' => $request->discount_p[$i],
                'current_price' => $request->c_price[$i],
            );
            $insert = Product_attribute::create($all);
        }

        return response()->json([
            'message'=>'success'
        ],200);
    }



    
    public function activity(Request $request){
        $data = Product::where('id',$request->id)->first();

        if ($data->status == 0) {
            Product::where('id',$request->id)->update([
                'status'=>1
            ]);

            return response()->json([
                'message'=>'success'
            ],200);
        }else{
            Product::where('id',$request->id)->update([
                'status'=>0
            ]);

            return response()->json([
                'message'=>'success'
            ],200);
        }

    }


    public function getProductById(Request $request){
     
        $product = Product::with('main_category','sub_category','child_category')->where('id',$request->id)->first();

        return response()->json([
            'message'=>'success',
            'product'=>$product
        ],200);
    }










}
