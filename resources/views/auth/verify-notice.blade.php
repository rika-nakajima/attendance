<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>メール認証が必要です</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header class="header header--guest">
    <div class="header__inner">
        <div class="header__logo">
            <img src="{{ asset('images/logo.png') }}" alt="Attendance ロゴ">
        </div>
    </div>
</header>

<main class="verify">
    <div class="verify__container">

        <h2 class="verify__title">メール認証が必要です</h2>

        <p class="verify__message">
            登録されたメールアドレスに認証メールを送信しました。<br>
            メール内のリンクをクリックして認証を完了してください。
        </p>

        {{-- 認証メール再送 --}}
        <form method="POST" action="{{ route('verification.send') }}" class="verify__form">
            @csrf
            <button type="submit" class="form__button">認証メールを再送する</button>
        </form>

        <div class="verify__link">
            <a href="{{ route('logout') }}">ログアウト</a>
        </div>

    </div>
</main>

</body>
</html>
