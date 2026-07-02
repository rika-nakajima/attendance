@extends('layouts.admin-guest')

@section('content')
<div class="admin-login-wrapper">

    <div class="admin-login-card">

        <h2 class="admin-login-title">管理者ログイン</h2>

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf

            {{-- メールアドレス --}}
            <div class="form-group">
                <label class="form-label">メールアドレス</label>
                <input type="email" name="email" class="form-input" value="{{ old('email') }}">
                @error('email')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            {{-- パスワード --}}
            <div class="form-group">
                <label class="form-label">パスワード</label>
                <input type="password" name="password" class="form-input">
                @error('password')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            {{-- ログイン情報が誤っている場合 --}}
            @if($errors->has('email') && !$errors->has('password'))
                <p class="error-text">ログイン情報が登録されていません</p>
            @endif

            <button class="admin-login-btn">管理者ログインする</button>
        </form>

    </div>

</div>
@endsection
