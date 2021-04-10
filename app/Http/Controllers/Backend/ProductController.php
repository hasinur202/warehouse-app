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
use App\Models\Child_category;
use App\Models\Main_category;
use App\Models\Sub_category;

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

        //upload multiple images
        $galleries = array();
        if($files=$request->file('gallery')){
            foreach($files as $img){
                $name = rand() . '.' . $img->getClientOriginalExtension();
                $upload_path = public_path()."/images/product/";
                $galleries[] = $name;
                $img->move($upload_path, $name);
            }
        }

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
            $pro->image1     = $galleries[0] ?? '';
            $pro->image2     = $galleries[1] ?? '';
            $pro->image3     = $galleries[2] ?? '';
            $pro->save();

            $pro->colors()->sync($request->product_color);
            $image->move($upload_path, $new_name);
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


    public function update(Request $request){

        $product = Product::where('id',$request->id)->first();
        if($product->product_name == $request->product_name){
            $update = true;
        }else{
            $cc = Product::where('product_name',$request->product_name)->count();
            if($cc > 0){
                $request->validate([
                    'product_name'  =>  'required|unique:products',
                ]);
            }else{
                $update = true;
            }
        }

        if($product->product_barcode == $request->product_barcode){
            $update1 = true;
        }else{
            $cc1 = Product::where('product_barcode',$request->product_barcode)->count();
            if($cc1 > 0){
                $request->validate([
                    'product_barcode'  =>  'required|unique:products',
                ]);
            }else{
                $update1 = true;
            }
        }

        if($product->product_sku == $request->product_sku){
            $update2 = true;
        }else{
            $cc2 = Product::where('product_sku',$request->product_sku)->count();
            if($cc2 > 0){
                $request->validate([
                    'product_sku'  =>  'required|unique:products',
                ]);
            }else{
                $update2 = true;
            }
        }


        if($update == true && $update1 == true && $update2 == true){
            if ($request->file('image')) {
                $image = $request->file('image');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $upload_path = public_path()."/images/product/";

                $d = public_path('images/product/').$product->feature_image;
                if(file_exists($d)){
                    @unlink($d);
                }

                $image->move($upload_path, $new_name);
            }else{
                $new_name = $product->feature_image;
            }

            if ($request->file('image1')) {
                $image1 = $request->file('image1');
                $new_name1 = rand() . '.' . $image1->getClientOriginalExtension();
                $upload_path = public_path()."/images/product/";

                $d = public_path('images/product/').$product->image1;
                if(file_exists($d)){
                    @unlink($d);
                }

                $image1->move($upload_path, $new_name1);
            }else{
                $new_name1 = $product->image1;
            }
            if ($request->file('image2')) {
                $image2 = $request->file('image2');
                $new_name2 = rand() . '.' . $image2->getClientOriginalExtension();
                $upload_path = public_path()."/images/product/";

                $d = public_path('images/product/').$product->image2;
                if(file_exists($d)){
                    @unlink($d);
                }

                $image2->move($upload_path, $new_name2);
            }else{
                $new_name2 = $product->image2;
            }
            if ($request->file('image3')) {
                $image3 = $request->file('image3');
                $new_name3 = rand() . '.' . $image3->getClientOriginalExtension();
                $upload_path = public_path()."/images/product/";

                $d = public_path('images/product/').$product->image3;
                if(file_exists($d)){
                    @unlink($d);
                }

                $image3->move($upload_path, $new_name3);
            }else{
                $new_name3 = $product->image3;
            }

            $pro = Product::find($product->id);
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
            $pro->image1     = $new_name1 ?? '';
            $pro->image2     = $new_name2 ?? '';
            $pro->image3     = $new_name3 ?? '';
            $pro->colors()->sync($request->product_color);
            $pro->save();



            Product_attribute::where('product_id',$request->id)->delete();
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

        }

        return response()->json([
            'message'=>'success'
        ],200);
    }




    public function getProductById(Request $request){
        $product = Product::with('attributes','colors')->where('id',$request->id)->first();

        $main_categories = Main_category::where('status',1)->get();
        $sub_categories = Sub_category::where('status',1)->get();
        $child_categories = Child_category::where('status',1)->get();
        $colors = Color::where('status',1)->get();

        return response()->json([
            'message'=>'success',
            'product'=>$product,
            'main_categories'=>$main_categories,
            'sub_categories'=>$sub_categories,
            'child_categories'=>$child_categories,
            'colors'=>$colors
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

}
