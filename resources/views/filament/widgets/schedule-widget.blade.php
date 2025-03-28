<div class="p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2 mb-4">
        <i class="fas fa-calendar-alt text-blue-500"></i> Jadwal Members Renang
    </h2>

    @if($schedules->isEmpty())
    <div class="text-center text-blue-500 p-3 bg-blue-100 rounded-md">
        <i class="fas fa-info-circle text-gray-500"></i> Tidak ada jadwal latihan untuk hari ini.
    </div>
    @else
    @foreach ($schedules->groupBy('hari') as $hari => $schedulePerHari)
    <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-700 bg-gray-200 p-3 rounded-md flex items-center gap-2">
            <i class="fas fa-calendar-day text-gray-500"></i> {{ ucwords($hari) }}
        </h3>

        <div class="mt-4 space-y-4">
            @foreach ($schedulePerHari->groupBy('sesi') as $sesi => $schedulePerSesi)
            <div class="p-4 rounded-md 
                            {{ $sesi === 'pagi' ? 'bg-green-100 border-l-4 border-green-500' : 'bg-indigo-100 border-l-4 border-indigo-500' }}">
                <h4 class="text-md font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fas {{ $sesi === 'pagi' ? 'fa-sun text-green-500' : 'fa-moon text-indigo-500' }}"></i>
                    {{ $sesi === 'pagi' ? 'Sesi Pagi (08:00 - 10:00)' : 'Sesi Sore (16:00 - 17:30)' }}
                </h4>
                <ul class="mt-2 space-y-1">
                    @foreach ($schedulePerSesi as $schedule)
                    <li class="text-gray-700 flex items-center gap-2">
                        <i class="fas fa-user text-gray-500"></i> {{ $schedule->member->nama ?? 'Tidak Ada' }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
    @endif
</div>