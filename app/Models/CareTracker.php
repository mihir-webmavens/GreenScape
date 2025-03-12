<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareTracker extends Model
{
protected $guarded=[];

public function plant()
{
    return $this->belongsTo(Plant::class, 'plant_id', 'id');
}

public function plantCollections()
{
    return $this->hasMany(PlantCollection::class, 'plant_id', 'plant_id');
}

public function users()
{
    return $this->hasManyThrough(User::class, PlantCollection::class, 'plant_id', 'id', 'plant_id', 'user_id');
}
}
