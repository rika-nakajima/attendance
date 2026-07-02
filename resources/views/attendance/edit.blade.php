@extends('layouts.app')

@section('title', '勤怠修正')

@section('content')
<main class="attendance-detail">

    <h2 class="attendance-list__title">勤怠修正</h2>

    <div class="detail-card">
        <form action="{{ route('attendance.update', $attendance->id) }}" method="POST">
            @csrf

            <table class="detail-table">
                <tr>
                    <th>日付</th>
                    <td>{{ \Carbon\Carbon::parse($attendance->date)->format('Y年 n月j日') }}</td>
                </tr>

                <tr>
                    <th>出勤</th>
                    <td>
                        <input type="time" name="clock_in" value="{{ $attendance->clock_in }}">
                    </td>
                </tr>

                <tr>
                    <th>退勤</th>
                    <td>
                        <input type="time" name="clock_out" value="{{ $attendance->clock_out }}">
                    </td>
                </tr>

                <tr>
                    <th>備考</th>
                    <td>
                        <textarea name="note" rows="3" style="width:100%;">{{ $attendance->note }}</textarea>
                    </td>
                </tr>
            </table>

            <div class="detail-actions">
                <button type="submit" class="btn-edit">更新</button>
            </div>
        </form>
    </div>

</main>
@endsection
