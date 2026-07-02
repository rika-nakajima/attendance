<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>退勤完了</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
</head>
<body>

@include('layouts.header')

<main class="attendance">

    <div class="attendance__date">
        {{ now()->format('Y年n月j日(D)') }}
    </div>

    <div class="attendance__time">
        {{ now()->format('H:i') }}
    </div>

    <div class="attendance__message" style="font-size:24px; margin-top:20px;">
        お疲れ様でした。
    </div>

</main>

</body>
</html>
