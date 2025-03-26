<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'alamat',
        'nomor_hp',
        'status_keanggotaan',
        'foto'
    ];

    
}
