<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理者ログイン</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="admin-login-body">

    <header class="admin-login-header">
        <div class="admin-login-header__inner">
            <img src="{{ asset('images/logo.png') }}" alt="COACHTECH" class="admin-login-logo">
        </div>
    </header>

    <main>
        @yield('content')
    </main>

</body>
</html>
