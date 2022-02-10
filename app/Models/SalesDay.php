<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TrainerProfile;

class SalesDay extends Model
{
    use HasFactory;

    public function TrainerProfile()
    {
        return $this->hasMany(TrainerProfile::class);
    }

    public function Time()
    {
        return $this->hasMany(Time::class);
    }
}
