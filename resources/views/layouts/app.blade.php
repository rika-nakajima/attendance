<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- ▼ ページタイトル（各ページで上書き可能） --}}
    <title>@yield('title', 'COACHTECH 勤怠管理')</title>

    {{-- ▼ 共通CSS（ヘッダーや基本レイアウト） --}}
    <link rel="stylesheet" href="{{ asset('css/attendance.css') }}">

    {{-- ▼ ページごとの追加CSS --}}
    @yield('css')
</head>

<body>

    {{-- ▼ 共通ヘッダー --}}
    @include('layouts.header')

    {{-- ▼ ページごとのコンテンツ --}}
    <main>
        @yield('content')
    </main>

</body>
</html>
