<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\BreakTime;
use Carbon\Carbon;

class AttendanceService
{
    /**
     * 今日のステータスを返す
     */
    public static function getTodayStatus($userId)
    {
        $today = Carbon::today()->toDateString();

        // 今日の勤怠レコードを取得
        $attendance = Attendance::where('user_id', $userId)
            ->where('date', $today)
            ->first();

        // レコードがない → 勤務外
        if (!$attendance) {
            return [
                'status' => 0,
                'label' => '勤務外',
                'attendance' => null,
            ];
        }

        // ステータスに応じてラベルを返す
        $labels = [
            0 => '勤務外',
            1 => '出勤中',
            2 => '休憩中',
            3 => '退勤済',
        ];

        return [
            'status' => $attendance->status,
            'label' => $labels[$attendance->status],
            'attendance' => $attendance,
        ];
    }
}
