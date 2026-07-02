@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/application.css') }}">

<div class="application-container">

    <h1 class="page-title">申請一覧</h1>

    <table class="application-table">
        <thead>
            <tr>
                <th>状態</th>
                <th>名前</th>
                <th>対象日程</th>
                <th>申請理由</th>
                <th>申請日</th>
                <th>判定</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($applications as $app)
                <tr>
                    <td>{{ $app['status'] }}</td>
                    <td>{{ $app['name'] }}</td>
                    <td>{{ $app['date'] }}</td>
                    <td>{{ $app['reason'] }}</td>
                    <td>{{ $app['applied_at'] }}</td>
                    <td><a href="#" class="detail-link">詳細</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
