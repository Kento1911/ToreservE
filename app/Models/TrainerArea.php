<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Area;

class TrainerArea extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_id',
        'type_id',
    ];

    public function Area()
    {
        return $this->belongsToMany(Area::class);
    }

    public function TrainerProfile()
    {
        return $this->belongsToMany(TrainerProfile::class);
    }
}
