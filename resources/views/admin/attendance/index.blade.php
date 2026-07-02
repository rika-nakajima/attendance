@extends('layouts.admin')

@section('content')
<h2 class="page-title">勤怠一覧</h2>

<div class="white-card">
    <table class="attendance-table">
        <thead>
            <tr>
                <th>名前</th>
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
                    <td>{{ $attendance->user->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($attendance->date)->format('m/d(D)') }}</td>
                    <td>{{ $attendance->clock_in ? \Carbon\Carbon::parse($attendance->clock_in)->format('H:i') : '-' }}</td>
                    <td>{{ $attendance->clock_out ? \Carbon\Carbon::parse($attendance->clock_out)->format('H:i') : '-' }}</td>

                    {{-- 休憩 --}}
                    <td>
                        @if ($attendance->break_start && $attendance->break_end)
                            {{ $attendance->break_start }}〜{{ $attendance->break_end }}
                        @else
                            -
                        @endif
                    </td>

                    {{-- 合計 --}}
                    <td>
                        @php
                            $breakMinutes = 0;
                            if ($attendance->break_start && $attendance->break_end) {
                                $breakMinutes = \Carbon\Carbon::parse($attendance->break_end)
                                    ->diffInMinutes(\Carbon\Carbon::parse($attendance->break_start));
                            }

                            if ($attendance->clock_in && $attendance->clock_out) {
                                $workMinutes = \Carbon\Carbon::parse($attendance->clock_out)
                                    ->diffInMinutes(\Carbon\Carbon::parse($attendance->clock_in)) - $breakMinutes;

                                $workFormatted = sprintf('%02d:%02d', floor($workMinutes/60), $workMinutes%60);
                            } else {
                                $workFormatted = '-';
                            }
                        @endphp
                        {{ $workFormatted }}
                    </td>

                    <td>
                        <a href="{{ route('admin.attendance.detail', $attendance->id) }}" class="detail-link">詳細</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
