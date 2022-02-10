<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Trainer;
use App\Models\TrainerArea;
use App\Models\Plan;
use App\Models\SalesDay;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrainerProfile extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'trainer_id	',
        'name',
        'sex',
        'profile_image',
        'profile_comment',
        'start_time',
        'end_time',
    ];


    public function Trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function TrainerArea()
    {
        return $this->hasMany(TrainerArea::class);
    }

    public function TrainerType()
    {
        return $this->hasMany(TrainerType::class);
    }

    public function Plan()
    {
        return $this->hasMany(Plan::class);
    }
    public function SalesDay()
    {
        return $this->belongsTo(SalesDay::class);
    } 
}
