<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    public function TrainerArea()
    {
        return $this->belongsToMany(TrainerArea::class);
    }

    public function schedule()
    {
        return $this->belongsToMany(Schedule::class,'id','area_id');
    }
}
