<header class="header-auth">
    <div class="header-auth__inner">
        <div class="header-auth__logo">
            <img src="{{ asset('images/logo.png') }}" alt="COACHTECH ロゴ">
        </div>

        <nav class="header-auth__nav">
            <ul class="header-auth__menu">
                <li><a href="{{ route('attendance') }}">勤怠</a></li>
                <li>
    <a href="{{ route('attendance.list', ['year' => now()->year, 'month' => now()->month]) }}">
        勤怠一覧
    </a>
</li>

                <li><a href="{{ route('application') }}">申請</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="logout-button">ログアウト</button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</header>
