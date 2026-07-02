@extends('layouts.admin')

@section('content')
<h2 class="page-title">申請一覧</h2>

{{-- ▼ 承認タブ --}}
<div class="approval-tabs">
    <a href="{{ route('admin.application.index', ['tab' => 'pending']) }}"
       class="tab {{ $tab === 'pending' ? 'active' : '' }}">
        申請待ち
    </a>

    <a href="{{ route('admin.application.index', ['tab' => 'approved']) }}"
       class="tab {{ $tab === 'approved' ? 'active' : '' }}">
        承認済み
    </a>
</div>

{{-- ▼ 白いカード --}}
<div class="white-card">
    <table class="application-table">
        <thead>
            <tr>
                <th>状態</th>
                <th>名前</th>
                <th>対象日程</th>
                <th>申請理由</th>
                <th>申請日</th>
                <th>詳細</th>
            </tr>
        </thead>

        <tbody>
            @foreach($applications as $app)
            <tr>
                <td>{{ $tab === 'pending' ? '承認待ち' : '承認済み' }}</td>
                <td>{{ $app->user->name }}</td>
                <td>{{ $app->target_date }}</td>
                <td>{{ $app->reason }}</td>
                <td>{{ $app->created_at->format('Y/m/d') }}</td>
                <td>
                    <a href="{{ route('admin.application.detail', $app->id) }}" class="detail-link">
                        詳細
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
