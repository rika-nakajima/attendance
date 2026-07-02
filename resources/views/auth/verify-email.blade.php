<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>メール認証完了</title>
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

        <h2 class="verify__title">メール認証が完了しました</h2>

        <p class="verify__message">
            認証が完了しました。ログインページへ進んでください。
        </p>

        <div class="verify__link">
            <a href="{{ route('login') }}" class="form__button">ログインへ</a>
        </div>

    </div>
</main>

</body>
</html>
