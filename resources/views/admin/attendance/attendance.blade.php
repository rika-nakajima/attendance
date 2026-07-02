@extends('layouts.admin')

@section('content')
<h2 class="page-title">勤怠一覧（{{ $user->name }}）</h2>

{{-- ▼ 月切り替え --}}
<div class="month-card">
    <div class="month-selector">

        <a class="month-btn"
           href="{{ route('admin.staff.attendance', [
                'id' => $user->id,
                'year' => $prevYear,
                'month' => $prevMonth
           ]) }}">
            <span class="arrow">＜</span> 前月
        </a>

        <div class="month-center">
            <img src="{{ asset('images/calendar.png') }}" class="calendar-icon" alt="calendar">
            <span class="month-text">{{ $year }}/{{ sprintf('%02d', $month) }}</span>
        </div>

        <a class="month-btn"
           href="{{ route('admin.staff.attendance', [
                'id' => $user->id,
                'year' => $nextYear,
                'month' => $nextMonth
           ]) }}">
            翌月 <span class="arrow">＞</span>
        </a>

    </div>
</div>

{{-- ▼ CSV出力 --}}
<div class="csv-area">
    <a href="{{ route('admin.staff.csv', ['id' => $user->id, 'year' => $year, 'month' => $month]) }}"
       class="csv-btn">CSV出力</a>
</div>

{{-- ▼ 勤怠一覧テーブル --}}
<div class="white-card">
    <table class="attendance-table">
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
            @foreach($attendances as $a)
            <tr>
                <td>{{ \Carbon\Carbon::parse($a->date)->format('m/d(D)') }}</td>

                <td>{{ $a->clock_in ? \Carbon\Carbon::parse($a->clock_in)->format('H:i') : '-' }}</td>
                <td>{{ $a->clock_out ? \Carbon\Carbon::parse($a->clock_out)->format('H:i') : '-' }}</td>

                {{-- 休憩 --}}
                <td>
                    @if ($a->break_start && $a->break_end)
                        {{ \Carbon\Carbon::parse($a->break_start)->format('H:i') }}
                        〜
                        {{ \Carbon\Carbon::parse($a->break_end)->format('H:i') }}
                    @else
                        -
                    @endif
                </td>

                {{-- 合計時間 --}}
                <td>
                    @php
                        $breakMinutes = 0;
                        if ($a->break_start && $a->break_end) {
                            $breakMinutes = \Carbon\Carbon::parse($a->break_end)
                                ->diffInMinutes(\Carbon\Carbon::parse($a->break_start));
                        }

                        if ($a->clock_in && $a->clock_out) {
                            $workMinutes = \Carbon\Carbon::parse($a->clock_out)
                                ->diffInMinutes(\Carbon\Carbon::parse($a->clock_in)) - $breakMinutes;

                            $workFormatted = sprintf('%02d:%02d', floor($workMinutes/60), $workMinutes%60);
                        } else {
                            $workFormatted = '-';
                        }
                    @endphp
                    {{ $workFormatted }}
                </td>

                <td>
                    <a href="{{ route('admin.attendance.detail', $a->id) }}" class="detail-link">詳細</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
