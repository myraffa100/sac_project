<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
       'user_id', 
        'schedule_id', 
        'tanggal', 
        'status_kehadiran', 
        'latitude', 
        'longitude'
    ];


    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
