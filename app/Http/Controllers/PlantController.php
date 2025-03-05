<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    public function show(){
        $plants = Plant::where('user_id', auth()->user()->id)->get();
        return view("frontend.plant",compact("plants"));
    }
    public function AddNewPlant(){
        return view("frontend.addnewplant");
    }
    public function InsertNewPlant(Request $request){
       $validate = $request->validate([
        'name'=> 'required',
        'watering'=>'required|numeric|min:0',
        'sunlight'=> 'required|numeric|min:0',
        'fertilizing' => 'required|numeric|min:0',
       ]);
    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        $imagepath = $request->file('image')->store('Plants', 'public');
    } else {
       $imagepath = "Plants/default.jpg";
    }

       $plant = Plant::create([
        'name'=> $request->name,
        'user_id'=> auth()->id(),
        'image'=> $imagepath,
        'watering_interval'=> $request->watering,
        'sunlight_interval'=> $request->sunlight,
        'fertilized_interval'=> $request->fertilizing,
        'next_watering'=> Carbon::now()->addDays((int)$request->watering),
        'last_watered'=> Carbon::now(),
        'next_sunlight'=> Carbon::now()->addDays((int)$request->sunlight),
        'last_sunlight'=> Carbon::now(),
        'next_fertilizing'=> Carbon::now()->addDays((int)$request->fertilizing),
        'last_fertilized'=> Carbon::now(),
       ]);

    return $request->all();

    }

    public function editPlant($id){
        $plant = Plant::find($id);
        return view('frontend.editplant',compact('plant'));
    }
    public function deletePlant($id){
        $plant = Plant::find($id)->delete();
        return redirect()->route('plant');
    }

}
