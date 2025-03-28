<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CoachSchedule; // Model untuk tabel coach_schedules
use Carbon\Carbon;

class CoachScheduleController extends Controller
{
    public function getCoachScheduleForToday()
    {
        $today = Carbon::now()->locale('id')->translatedFormat('l'); // Mendapatkan hari dalam bahasa Indonesia
        $now = Carbon::today(); // Mendapatkan tanggal hari ini

        $coachSchedules = CoachSchedule::whereJsonContains('hari', $today) // Filter berdasarkan hari
            ->whereDate('start_date', '<=', $now) // Mulai dari tanggal yang valid
            ->whereDate('end_date', '>=', $now) // Masih dalam rentang waktu aktif
            ->with('coach') // Ambil informasi coach jika ada relasi
            ->get();

        if ($coachSchedules->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Tidak ada jadwal coach untuk hari ini.',
                'data' => []
            ], 200);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Jadwal coach berhasil diambil.',
            'data' => $coachSchedules
        ], 200);
    }
}
