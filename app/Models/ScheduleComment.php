<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleComment extends Model
{
    use HasFactory;

    public function shcedule()
    {
        return $this->belongsToMany(Schedule::class);
    }

    protected $fillable = [
        'schedule_id',
        'sender',
        'receiver',
        'comment',
    ];

}
