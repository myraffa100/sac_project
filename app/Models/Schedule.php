<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';

    protected $fillable = [
        'member_id',
        'coach_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'status',
        'sesi',
        'start_date',
        'end_date'
    ];

    // Relasi ke Member
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    // Relasi ke Coach
    public function coach()
    {
        return $this->belongsTo(Coach::class, 'coach_id');
    }
}
