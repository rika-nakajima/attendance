@extends('layouts.admin')

@section('content')
<h2 class="page-title">申請詳細</h2>

{{-- ▼ 承認タブ --}}
<div class="approval-tabs">
    <a href="{{ route('admin.application.index', ['tab' => 'pending']) }}"
       class="tab {{ $app->status === 'pending' ? 'active' : '' }}">
        承認待ち
    </a>

    <a href="{{ route('admin.application.index', ['tab' => 'approved']) }}"
       class="tab {{ $app->status === 'approved' ? 'active' : '' }}">
        承認済み
    </a>
</div>

{{-- ▼ 白いカード --}}
<div class="detail-card">

    <table class="detail-table">
        <tr>
            <th>名前</th>
            <td>{{ $app->user->name }}</td>
        </tr>

        <tr>
            <th>対象日程</th>
            <td>{{ $app->target_date }}</td>
        </tr>

        <tr>
            <th>申請理由</th>
            <td>{{ $app->reason }}</td>
        </tr>

        <tr>
            <th>申請日</th>
            <td>{{ $app->created_at->format('Y/m/d') }}</td>
        </tr>

        <tr>
            <th>修正前</th>
            <td>
                出勤：{{ $app->attendance->clock_in }}<br>
                退勤：{{ $app->attendance->clock_out }}
            </td>
        </tr>

        <tr>
            <th>修正後</th>
            <td>
                出勤：{{ $app->new_clock_in }}<br>
                退勤：{{ $app->new_clock_out }}
            </td>
        </tr>

        <tr>
            <th>備考</th>
            <td>{{ $app->new_note }}</td>
        </tr>
    </table>

    {{-- ▼ 承認ボタン（承認待ちのときだけ） --}}
    @if($app->status === 'pending')
    <div class="detail-actions">
        <form method="POST" action="{{ route('admin.application.approve', $app->id) }}">
            @csrf
            <button class="btn-approve">承認</button>
        </form>
    </div>
    @endif

</div>
@endsection
