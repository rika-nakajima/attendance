<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>勤怠打刻</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/attendance.css') }}">

</head>
<body>

@include('layouts.header')

<main class="attendance">

    {{-- ▼ ステータス（大きいグレーのラベル） --}}
    <div class="attendance__status-box">
        {{ $status_label }}
    </div>

    {{-- ▼ 日付 --}}
    <div class="attendance__date">
        {{ now()->format('Y年n月j日(D)') }}
    </div>

    {{-- ▼ 時刻 --}}
    <div class="attendance__time">
        {{ now()->format('H:i') }}
    </div>

    {{-- ▼ ボタン --}}
    <div class="attendance__actions {{ ($status === 1 || $status === 2) ? 'attendance__actions--row' : '' }}">


        {{-- 勤務外 → 出勤 --}}
        @if ($status === 0)
            <form method="POST" action="{{ route('attendance.start') }}">
                @csrf
                <button class="btn btn--black">出勤</button>
            </form>
        @endif

        {{-- 出勤中 → 退勤 / 休憩入 --}}
        @if ($status === 1)
            <form method="POST" action="{{ route('attendance.end') }}">
                @csrf
                <button class="btn btn--black">退勤</button>
            </form>

            <form method="POST" action="{{ route('attendance.break.start') }}">
                @csrf
                <button class="btn btn--white">休憩入</button>
            </form>
        @endif

        {{-- 休憩中 → 休憩戻 / 退勤 --}}
        @if ($status === 2)
            <form method="POST" action="{{ route('attendance.break.end') }}">
                @csrf
                <button class="btn btn--white">休憩戻</button>
            </form>

            
        @endif

    </div>

</main>


</body>
</html>
