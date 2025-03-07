<?php

namespace App\Livewire;

use App\Models\CareTracker;
use App\Models\Plant;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;


class PlantTracker extends Component
{
    use WithFileUploads;
    public $plants, $plant_id, $name, $image;
    public $events,$user_id,$title,$start,$end,$color;
    public $showModal = false, $eventList = false;

    public function removePlant($id)
    {
        $plant = Plant::find($id);
        if ($plant) {
            $plant->delete();
        }
    }
    public function removeEvent($id)
    {
        $event = CareTracker::find($id);
        if ($event) {
            $event->delete();
        }
    }
    public function addOrUpdateEvent()
    {
            $this->validate([
                'title'=>'required',
                'start' => 'required|date|after_or_equal:today',
                'end'=>'required',
                'color'=>'required',
            ]);
        CareTracker::Create([
            'title'=>$this->title,
            'start'=>$this->start,
            'end'=>$this->end,
            'color'=>$this->color,
            'plant_id'=>$this->plant_id,
        ]);

        $this->title = null;
        $this->start = null;
        $this->end = null;
        $this->color = null;
        
    }

    public function addPlant()
    {
        $this->name = $this->image = "";
        $this->showModal = true;
    }
    public function editPlant($id)
    {
        $plant = Plant::find($id);
        $this->plant_id = $plant->id;
        $this->name = $plant->name;
        $this->image = $plant->image;
        $this->showModal = true;
    }

    public function addOrUpdatePlant()
    {
        $validate = $this->validate([
            'name' => 'required',
            'image' => 'nullable|max:1024',
        ]);
        // complate code for image if image exist old image will be delte.
        $plant = Plant::find($this->plant_id);
        if ($this->plant_id) {
            if ($this->image) {
                if ($this->image !== $plant->image) {
                    if ($this->image && file_exists(public_path('storage/' . $plant->image))) {
                        Storage::disk('public')->delete($plant->image);
                    }
                    $imageName = $this->image->store('Plants', 'public');
                }else{
                    $imageName = $plant->image;
                }
            } else {
                $imageName = $plant->image;
            }
        } else {
            if ($this->image) {
                // dd($this->image);
                $imageName = $this->image->store('Plants', 'public');
            } else {
                $imageName = "Plants/default.jpg";
            }
        }

        Plant::updateOrCreate(
            ['id' => $this->plant_id],
            ['name' => $this->name, 'image' => $imageName]
        );
        $this->showModal = false;
    }
    public function closeModal()
    {
        $this->showModal = false;
        $this->eventList = false;
    }

    public function addEvent($id)
    {
        $this->plant_id = $id;
        $this->eventList = true;
    }

    public function render()
    {
        $this->plants = Plant::all();
        $this->events = CareTracker::all();
        return view('livewire.plant-tracker');
    }
}
