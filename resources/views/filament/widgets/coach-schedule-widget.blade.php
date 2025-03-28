@php
use Illuminate\Support\Str;
@endphp

<div class="p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2 mb-4">
        <i class="fas fa-chalkboard-teacher text-blue-500"></i> Coach Schedule for Today
    </h2>

    @if($coachSchedules->isEmpty())
    <div class="text-center text-blue-500 p-3 bg-blue-100 rounded-md">
        <i class="fas fa-info-circle text-gray-500"></i> No coach schedule available today.
    </div>
    @else
    <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-700 bg-gray-200 p-3 rounded-md flex items-center gap-2">
            <i class="fas fa-calendar-day text-gray-500"></i> {{ Str::title($today) }}
        </h3>

        <div class="mt-4 space-y-4">
            @foreach ($coachSchedules->groupBy('sesi') as $sesi => $schedulePerSesi)
            @php
            $isMorning = Str::contains(Str::lower($sesi), 'pagi');
            $isAfternoon = Str::contains(Str::lower($sesi), 'sore');
            $isFullDay = Str::contains(Str::lower($sesi), 'full day');

            $bgColor = $isMorning ? 'bg-green-100 border-l-4 border-green-500'
            : ($isAfternoon ? 'bg-yellow-100 border-l-4 border-yellow-500'
            : 'bg-blue-100 border-l-4 border-blue-500');

            $icon = $isMorning ? 'fa-sun text-green-500'
            : ($isAfternoon ? 'fa-cloud-sun text-yellow-500'
            : 'fa-calendar-alt text-blue-500');

            $sesiLabel = match ($sesi) {
            'pagi' => 'Sesi Pagi (08:00 - 10:00)',
            'sore' => 'Sesi Sore (16:00 - 17:30)',
            'full_day' => 'Full Day (08:00 - 17:30)',
            default => Str::title($sesi)
            };
            @endphp

            <div class="p-4 rounded-md {{ $bgColor }}">
                <h4 class="text-md font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fas {{ $icon }}"></i>
                    {{ $sesiLabel }}
                </h4>
                <ul class="mt-2 space-y-1">
                    @foreach ($schedulePerSesi as $schedule)
                    <li class="text-gray-700 flex items-center gap-2">
                        <i class="fas fa-user text-gray-500"></i>
                        {{ $schedule->coach->nama ?? 'Coach Not Found' }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>