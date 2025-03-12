<?php

namespace App\Livewire;

use App\Models\Plant;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use App\Models\PlantCollection as ModelsPlantCollection;

class PlantCollection extends Component
{
    public $plants,$collections,$plant_id,$user_id; 
    public $showModel= false; 
    public function addPlant()
    {
        $this->showModel = true;
    }
    public function closeModal()
    {
        $this->showModel = false;
    }
    public function addToGallery($id)
    {
        if (!ModelsPlantCollection::where('user_id', auth()->id())->where('plant_id', $id)->exists()) {
            ModelsPlantCollection::create([
            'user_id' => auth()->id(),
            'plant_id' => $id
            ]);
            session()->flash('message', 'Plant added to your collection successfully.');
        } else {
            session()->flash('message', 'Plant is already in your collection.');
        }

    }
    public function deletePlant($id)
    {
       $plant = ModelsPlantCollection::find($id);

       if($plant){
        $plant->delete();
        session()->flash('delete', 'Plant removed from your collection successfully.');
       }
               
    }
    public function render()
    {
        $this->plants = Plant::all();
        Log::info(auth()->id());
        $this->collections = ModelsPlantCollection::with(['user','plant'])->where('user_id',auth()->id())->get();
        return view('livewire.plant-collection');
    }
}
