<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新規登録</title>
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

    <main class="register">
        <div class="register__container">

            <h2 class="register__title">新規登録</h2>

            {{-- ▼ 登録フォーム --}}
            <form method="POST" action="{{ route('register') }}" class="register__form">
                @csrf

                {{-- ▼ 名前 --}}
                <div class="form__group">
                    <label for="name" class="form__label">名前</label>
                    <input id="name" type="text" name="name" class="form__input" value="{{ old('name') }}">

                    @error('name')
                        <div class="form__error">{{ $message }}</div>
                    @enderror
                </div>

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

                {{-- ▼ パスワード確認 --}}
                <div class="form__group">
                    <label for="password_confirmation" class="form__label">パスワード（確認）</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="form__input">

                    @error('password_confirmation')
                        <div class="form__error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ▼ 登録ボタン --}}
                <div class="form__group">
                    <button type="submit" class="form__button">登録する</button>
                </div>
            </form>

            {{-- ▼ ログインリンク --}}
            <div class="register__link">
                <a href="{{ route('login') }}">ログインはこちら</a>
            </div>

        </div>
    </main>

</body>
</html>
