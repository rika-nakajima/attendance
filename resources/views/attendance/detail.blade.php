@extends('layouts.app')

@section('title', '勤怠詳細')

@section('content')
<main class="attendance-detail">

    {{-- ▼ タイトル --}}
    <h2 class="page-title">勤怠詳細</h2>

    {{-- ▼ 承認タブ --}}
    <div class="approval-tabs">
        <a href="{{ route('attendance.detail', ['id' => $attendance->id, 'tab' => 'pending']) }}"
           class="tab {{ request('tab') === 'pending' ? 'active' : '' }}">
            承認待ち
        </a>

        <a href="{{ route('attendance.detail', ['id' => $attendance->id, 'tab' => 'approved']) }}"
           class="tab {{ request('tab') === 'approved' ? 'active' : '' }}">
            承認済み
        </a>
    </div>

    {{-- ▼ 白いカード --}}
    <div class="detail-card">

        <table class="detail-table">
            <tr>
                <th>名前</th>
                <td>{{ $attendance->user->name }}</td>
            </tr>

            <tr>
                <th>日付</th>
                <td>{{ \Carbon\Carbon::parse($attendance->date)->format('Y年n月j日') }}</td>
            </tr>

            <tr>
                <th>出勤・退勤</th>
                <td>
                    {{ $attendance->clock_in }} ～ {{ $attendance->clock_out }}
                </td>
            </tr>

            <tr>
                <th>休憩</th>
                <td>
                    @foreach ($attendance->breakTimes as $break)
                        {{ $break->break_start }} ～ {{ $break->break_end }}<br>
                    @endforeach
                </td>
            </tr>

            <tr>
                <th>備考</th>
                <td>{{ $attendance->note }}</td>
            </tr>
        </table>

        {{-- ▼ 修正ボタン（承認待ちのみ表示） --}}
        @if(request('tab') === 'pending')
            <div class="detail-actions">
                <a href="{{ route('attendance.edit', $attendance->id) }}" class="btn-edit">修正</a>
            </div>
        @endif

    </div>

</main>
@endsection
