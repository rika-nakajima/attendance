<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

</head>

<body>

    {{-- ▼ ログイン前ヘッダー --}}
    <header class="header header--guest">
        <div class="header__inner">
            {{-- ▼ ロゴ画像（左側） --}}
            <div class="header__logo">
                <img src="{{ asset('images/logo.png') }}" alt="Attendance ロゴ">
            </div>
        </div>
    </header>

    <main class="login">
        <div class="login__container">

            <h2 class="login__title">ログイン</h2>

            {{-- ▼ ログインフォーム --}}
            <form method="POST" action="{{ route('login.post') }}" class="login__form">
                @csrf

                {{-- ▼ メールアドレス --}}
                <div class="form__group">
                    <label for="email" class="form__label">メールアドレス</label>
                    <input id="email" type="email" name="email" class="form__input" value="{{ old('email') }}">

                    @error('email')
                        <div class="form__error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ▼ パスワード --}}
                <div class="form__group">
                    <label for="password" class="form__label">パスワード</label>
                    <input id="password" type="password" name="password" class="form__input">

                    @error('password')
                        <div class="form__error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ▼ ログインボタン --}}
                <div class="form__group">
                    <button type="submit" class="form__button">ログイン</button>
                </div>
            </form>

            {{-- ▼ 新規登録リンク --}}
            <div class="login__link">
                <a href="{{ route('register') }}">新規登録はこちら</a>
            </div>

        </div>
    </main>

</body>
</html>
