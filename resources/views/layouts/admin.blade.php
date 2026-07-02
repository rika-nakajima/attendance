<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理画面</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

<header class="admin-header">
    <div class="admin-header__inner">
        <div class="admin-header__logo">
            <img src="{{ asset('images/logo.png') }}" alt="COACHTECH">
        </div>

        <nav class="admin-header__nav">
            <a href="{{ route('admin.attendance.index') }}">勤怠一覧</a>
            <a href="{{ route('admin.staff.index') }}">スタッフ一覧</a>
            <a href="{{ route('admin.application.index') }}">申請一覧</a>

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">ログアウト</button>
            </form>
        </nav>
    </div>
</header>



<main class="admin-main">
    @yield('content')
</main>

</body>
</html>
