<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoachSchedule extends Model
{
    use HasFactory;

    protected $table = 'coach_schedules'; // Nama tabel di database
    protected $fillable = ['coach_id', 'hari', 'sesi', 'start_date', 'end_date'];

    protected $casts = [
        'hari' => 'array', // Pastikan kolom hari dikonversi ke array otomatis
    ];

    public function coach()
    {
        return $this->belongsTo(Coach::class, 'coach_id');
    }
}
