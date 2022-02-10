<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Plan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'trainer_profile_id',
        'plan_name',
        'time',
        'price',
        'introduction',
    ];

     public function TrainerProfile()
     {
         return $this->belongsToMany(TrainerProfile::class);
     }

     public function schedule()
    {
        return $this->belongsToMany(Schedule::class);
    }
}
