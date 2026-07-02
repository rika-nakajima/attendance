@extends('layouts.app')

@section('title', '勤怠一覧')

@section('content')
<main class="attendance-list">

    <h2 class="attendance-list__title">勤怠一覧</h2>

    {{-- ▼ 月切り替え --}}
    <div class="month-card">
    <div class="month-selector">

        {{-- ▼ 前月 --}}
        <a class="month-btn" 
           href="{{ route('attendance.list', [
                'year' => \Carbon\Carbon::create($year, $month)->subMonth()->year,
                'month' => \Carbon\Carbon::create($year, $month)->subMonth()->month
           ]) }}">
            <span class="arrow">←</span> 前月
        </a>

        {{-- ▼ カレンダーアイコン + 月 --}}
        <div class="month-center">
            <img src="{{ asset('images/calendar.png') }}" class="calendar-icon" alt="calendar">
            <span class="month-text">{{ $year }}/{{ sprintf('%02d', $month) }}</span>
        </div>

        {{-- ▼ 翌月 --}}
        <a class="month-btn" 
           href="{{ route('attendance.list', [
                'year' => \Carbon\Carbon::create($year, $month)->addMonth()->year,
                'month' => \Carbon\Carbon::create($year, $month)->addMonth()->month
           ]) }}">
            翌月 <span class="arrow">→</span>
        </a>

    </div>
</div>



    <table class="attendance-list__table">
        <thead>
            <tr>
                <th>日付</th>
                <th>出勤</th>
                <th>退勤</th>
                <th>休憩</th>
                <th>合計</th>
                <th>詳細</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($attendances as $attendance)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($attendance->date)->format('m/d(D)') }}</td>
                    <td>{{ $attendance->clock_in ? \Carbon\Carbon::parse($attendance->clock_in)->format('H:i') : '-' }}</td>
                    <td>{{ $attendance->clock_out ? \Carbon\Carbon::parse($attendance->clock_out)->format('H:i') : '-' }}</td>

                    {{-- 休憩合計 --}}
                    <td>
                        @php
                            $breakTotal = $attendance->breakTimes->sum(function($b){
                                if ($b->break_start && $b->break_end) {
                                    return \Carbon\Carbon::parse($b->break_end)->diffInMinutes($b->break_start);
                                }
                                return 0;
                            });
                            $breakFormatted = sprintf('%02d:%02d', floor($breakTotal/60), $breakTotal%60);
                        @endphp
                        {{ $breakFormatted }}
                    </td>

                    {{-- 勤務合計 --}}
                    <td>
                        @if ($attendance->clock_in && $attendance->clock_out)
                            @php
                                $workMinutes = \Carbon\Carbon::parse($attendance->clock_out)
                                    ->diffInMinutes(\Carbon\Carbon::parse($attendance->clock_in)) - $breakTotal;

                                $workFormatted = sprintf('%02d:%02d', floor($workMinutes/60), $workMinutes%60);
                            @endphp
                            {{ $workFormatted }}
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('attendance.detail', $attendance->id) }}" class="detail-link">詳細</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</main>
@endsection



