<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mockery\Matcher\Type;

class TrainerType extends Model
{
    use HasFactory;

    protected $fillable = [
        'trainer_id',
        'type_id',
    ];

    public function Type()
    {
        return $this->belongsToMany(Type::class);
    }

    public function TrainerProfile()
    {
        return $this->belongsTo(TrainerProfile::class);
    }
}
