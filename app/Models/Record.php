<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_id',
        'menu',
        'feedback',
    ];

    public function Schedule()
    {
        return $this->hasMany(Schedule::class);
    }
}
