@extends('layouts.admin')

@section('content')
<div class="staff-list-wrapper">
    <h2 class="page-title">スタッフ一覧</h2>

    <div class="staff-card">
        <table class="staff-table">
            <thead>
                <tr>
                    <th>氏名</th>
                    <th>メールアドレス</th>
                    <th>詳細</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('admin.staff.attendance', [
                            'id' => $user->id,
                            'year' => now()->year,
                            'month' => now()->month
                        ]) }}" class="detail-link">詳細</a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
