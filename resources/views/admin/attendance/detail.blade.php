@extends('layouts.admin')

@section('content')
<div class="attendance-detail-wrapper">

    <h2 class="page-title">勤怠詳細（{{ $attendance->user->name }}）</h2>

    <div class="white-card detail-card">

        {{-- ★ 承認待ちメッセージ（FN038） --}}
        @if ($attendance->status === 0)
            <p class="error-text">承認待ちのため修正はできません。</p>
        @endif

        {{-- ★ バリデーションエラー（共通） --}}
        @if ($errors->any())
            <div class="error-text">
                入力内容に誤りがあります。確認してください。
            </div>
        @endif

        <form action="{{ route('admin.attendance.update', $attendance->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- 日付（編集不可） --}}
            <div class="form-group">
                <label class="form-label">日付</label>
                <input type="text" class="form-input" value="{{ $attendance->date }}" disabled>
            </div>

            {{-- 出勤 --}}
            <div class="form-group">
                <label class="form-label">出勤時間</label>
                <input type="time" name="clock_in" class="form-input"
                       value="{{ $attendance->clock_in ? \Carbon\Carbon::parse($attendance->clock_in)->format('H:i') : '' }}"
                       @if($attendance->status === 0) disabled @endif>
                @error('clock_in')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            {{-- 退勤 --}}
            <div class="form-group">
                <label class="form-label">退勤時間</label>
                <input type="time" name="clock_out" class="form-input"
                       value="{{ $attendance->clock_out ? \Carbon\Carbon::parse($attendance->clock_out)->format('H:i') : '' }}"
                       @if($attendance->status === 0) disabled @endif>
                @error('clock_out')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            {{-- 休憩開始 --}}
            <div class="form-group">
                <label class="form-label">休憩開始</label>
                <input type="time" name="break_start" class="form-input"
                       value="{{ $attendance->break_start }}"
                       @if($attendance->status === 0) disabled @endif>
                @error('break_start')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            {{-- 休憩終了 --}}
            <div class="form-group">
                <label class="form-label">休憩終了</label>
                <input type="time" name="break_end" class="form-input"
                       value="{{ $attendance->break_end }}"
                       @if($attendance->status === 0) disabled @endif>
                @error('break_end')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            {{-- 備考 --}}
            <div class="form-group">
                <label class="form-label">備考</label>
                <textarea name="note" class="form-textarea"
                          @if($attendance->status === 0) disabled @endif>{{ $attendance->note }}</textarea>
                @error('note')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-actions">

                {{-- ★ 承認待ちのときは修正ボタンを非表示（FN038） --}}
                @if ($attendance->status !== 0)
                    <button class="submit-btn">修正する</button>
                @endif

                <a href="{{ route('admin.staff.attendance', [
                        'id' => $attendance->user->id,
                        'year' => now()->year,
                        'month' => now()->month
                    ]) }}"
                   class="cancel-link">一覧に戻る</a>
            </div>
        </form>
    </div>
</div>
@endsection
