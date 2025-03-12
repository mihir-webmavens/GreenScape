<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlantCollection extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function plant()
    {
        return $this->belongsTo(Plant::class, 'plant_id', 'id');
    }
}
