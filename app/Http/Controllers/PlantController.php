<?php

namespace App\Http\Controllers;

use App\Models\CareTracker;
use App\Models\Plant;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    public function show(){
        $plants = Plant::all();
        return view("frontend.plant",compact("plants"));
    }
  
    public function carePlant(){
       $plant = Plant::all();
        return view('backend.plantTracker',compact('plant'));
    }
    public function editPlant($id){
        $plant = Plant::find($id);
        $events = CareTracker::where('plant_id',$id)->get();
        return view('frontend.editplant',compact('plant','events'));
    }
   
}
