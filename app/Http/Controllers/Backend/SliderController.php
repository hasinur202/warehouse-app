<?php

namespace App\Http\Controllers\backend;

use App\Models\Slide;
use App\Models\Warehouse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class SliderController extends Controller
{
    public function index(){

        $warehouses = Warehouse::where('status',1)->get();
        $slides = Slide::with('get_warehouse')->get();

        return view('layouts.backend.slider.slider',[
            'slides'=>$slides,
            'warehouses'=>$warehouses ?? '',
        ]);
    }


    public function test(Request $request){
        dd($request->all());
    }

    public function store(Request $request){
        $request->validate([
            'title'  =>  'required|unique:slides',
        ]);

        if ($request->file('image')) {
            $image = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $upload_path = public_path()."/images/slider/";

            $sll = Slide::create([
                'warehouse_id'=>$request->warehouse_id,
                'title'=>$request->title,
                'slug'=>Str::slug($request->title),
                'image'=>$new_name,
                'url'=>$request->url ?? '#',
                'status'=>1
            ]);

            if($sll){
                $image->move($upload_path, $new_name);
            }

            return response()->json([
                'message'=>'success'
            ],200);
        }
    }

    public function update(Request $request){
        $data = Slide::where('id',$request->id)->first();
        if ($request->file('image')) {
            $image = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $upload_path = public_path()."/images/slider/";
        }else{
            $new_name=$data->image;
        }

        if($data->title == $request->title){
            $slugg = $request->title;
        }else{
            $checkslug = Slide::where('title',$request->title)->count();
            if($checkslug > 0){
                Alert::warning('Opps...','Slide title should be unique!');
                return redirect()->back();
            }else{
                $slugg = $request->title;
            }
        }

        $slld = Slide::where('id',$request->id)->update([
            'warehouse_id'=>$request->warehouse_id,
            'title'=>$request->title,
            'url'=>$request->url ?? '#',
            'image'=>$new_name,
            'slug'=>Str::slug($slugg),
        ]);

        if ($request->file('image') !=null ){
            $icon_d = public_path('images/slider/').$data->image;
            if(file_exists($icon_d)){
                @unlink($icon_d);
            }
            $image->move($upload_path, $new_name);
        }
        if($slld){
            toast('Created successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                return redirect()->back();
        }else{
            Alert::warning('Opps...','Something went wrong!');
                return redirect()->back();
        }

    }


    public function activity(Request $request){
        $data = Slide::where('id',$request->id)->first();

        if ($data->status == 0) {
            Slide::where('id',$request->id)->update([
                'status'=>1
            ]);

            return response()->json([
                'message'=>'success'
            ],200);
        }else{
            Slide::where('id',$request->id)->update([
                'status'=>0
            ]);

            return response()->json([
                'message'=>'success'
            ],200);
        }

    }






}
