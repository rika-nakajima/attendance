<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * ★ 勤怠一覧（管理者）
     * 要件：
     * - その日になされた全ユーザーの勤怠情報が正確に確認できる
     * - 遷移した際に現在の日付が表示される
     * - 「前日」「翌日」で日付が切り替わる
     */
    public function index()
    {
        // 今日をデフォルト日付にする
        $date = request()->input('date', Carbon::today()->format('Y-m-d'));

        // 指定日の勤怠を取得（ユーザー情報も取得）
        $attendances = Attendance::with('user')
            ->whereDate('date', $date)
            ->get();

        // 前日・翌日の計算
        $prevDate = Carbon::parse($date)->subDay()->format('Y-m-d');
        $nextDate = Carbon::parse($date)->addDay()->format('Y-m-d');

        return view('admin.attendance.index', compact(
            'attendances',
            'date',
            'prevDate',
            'nextDate'
        ));
    }

    /**
     * ★ 勤怠詳細（管理者）
     * 要件：
     * - 選択した勤怠情報が正しく表示される
     */
    public function detail($id)
    {
        $attendance = Attendance::with('user')->findOrFail($id);

        return view('admin.attendance.detail', compact('attendance'));
    }
}
