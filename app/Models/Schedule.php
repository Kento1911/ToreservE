<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;


    protected $fillable = [
        'trainer_id',
        'user_id',
        'plan_id',
        'area_id',
        'time_id',
        'date',
        'user_comment',
        'state_flg'
    ];

    public function user()
    {
        return $this->hasMany(User::class,'id','user_id');
    }

    public function trainer()
    {
        return $this->hasMany(Trainer::class,'id','trainer_id');
    }

    public function area()
    {
        return $this->hasMany(Area::class,'id','area_id');
    }

    public function plan()
    {
        return $this->hasMany(Plan::class,'id','plan_id');
    }

    public function time()
    {
        return $this->hasMany(Time::class,'id','time_id');
    }

    public function schedule_comment()
    {
        return $this->hasMany(ScheduleComment::class);
    }

    public function record()
    {
        return $this->belongsTo(Record::class);
    }
}
