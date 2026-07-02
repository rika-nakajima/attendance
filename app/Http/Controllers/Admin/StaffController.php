<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Attendance;

class StaffController extends Controller
{
    public function index()
    {
        $users = User::select('id', 'name', 'email')->get();
        return view('admin.staff.index', compact('users'));
    }

    public function attendance($userId)
    {
        $year = request('year', now()->year);
        $month = request('month', now()->month);

        $user = User::findOrFail($userId);

        $attendances = Attendance::where('user_id', $userId)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->orderBy('date')
            ->get();

        $current = \Carbon\Carbon::create($year, $month, 1);
        $prev = $current->copy()->subMonth();
        $next = $current->copy()->addMonth();

        return view('admin.staff.attendance', [
            'user' => $user,
            'attendances' => $attendances,
            'year' => $year,
            'month' => $month,
            'prevYear' => $prev->year,
            'prevMonth' => $prev->month,
            'nextYear' => $next->year,
            'nextMonth' => $next->month,
        ]);
    }

    // ★★★ ここに追加する ★★★
    public function exportCsv($userId, $year, $month)
    {
        $user = User::findOrFail($userId);

        $attendances = Attendance::where('user_id', $userId)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->orderBy('date')
            ->get();

        $csvHeader = [
            '日付',
            '出勤',
            '退勤',
            '休憩開始',
            '休憩終了',
            '備考'
        ];

        $csvData = [];
        foreach ($attendances as $a) {
            $csvData[] = [
                $a->date,
                $a->clock_in,
                $a->clock_out,
                $a->break_start,
                $a->break_end,
                $a->note,
            ];
        }

        $fileName = "{$user->name}_{$year}年{$month}月_勤怠.csv";

        return response()->streamDownload(function () use ($csvHeader, $csvData) {
            $stream = fopen('php://output', 'w');
            fprintf($stream, chr(0xEF).chr(0xBB).chr(0xBF)); // Excel用BOM

            fputcsv($stream, $csvHeader);

            foreach ($csvData as $row) {
                fputcsv($stream, $row);
            }

            fclose($stream);
        }, $fileName);
    }
}
