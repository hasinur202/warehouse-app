<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Measurement_type;
use Illuminate\Http\Request;

class MeasurementController extends Controller
{
    public function index(){

        $measurements = Measurement_type::all();

        return view('layouts.backend.measurement.measurement',[
            'measurements'=>$measurements,
        ]);
    }
}
