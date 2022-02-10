<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'hour',
        'minute',
    ];

    public function SalesDay(){
        return $this->belongsTo(SalesDay::class);
    }

    public function schedule()
    {
        return $this->belongsToMany(Schedule::class);
    }
}
