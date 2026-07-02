<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;  // ← これが必要！
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\BreakTime;
use App\Services\AttendanceService;
use Carbon\Carbon;


class AttendanceController extends Controller
{
    // 勤怠画面
    public function index()
    {
        $result = AttendanceService::getTodayStatus(Auth::id());

        return view('attendance.index', [
            'status' => $result['status'],
            'status_label' => $result['label'],
            'attendance' => $result['attendance'],
        ]);
    }

    // 出勤
    public function start()
    {
        $userId = Auth::id();
        $today = Carbon::today()->toDateString();

        $attendance = Attendance::where('user_id', $userId)
            ->where('date', $today)
            ->first();

        if ($attendance && $attendance->clock_in) {
            return redirect()->route('attendance');
        }

        if (!$attendance) {
            Attendance::create([
                'user_id' => $userId,
                'date' => $today,
                'clock_in' => Carbon::now(),
                'status' => 1,
            ]);
        } else {
            $attendance->update([
                'clock_in' => Carbon::now(),
                'status' => 1,
            ]);
        }

        return redirect()->route('attendance');
    }

    // 休憩入
    public function breakStart()
    {
        $userId = Auth::id();
        $today = Carbon::today()->toDateString();

        $attendance = Attendance::where('user_id', $userId)
            ->where('date', $today)
            ->first();

        if (!$attendance || $attendance->status !== 1) {
            return redirect()->route('attendance');
        }

        BreakTime::create([
            'attendance_id' => $attendance->id,
            'break_start' => Carbon::now(),
        ]);

        $attendance->update([
            'status' => 2,
        ]);

        return redirect()->route('attendance');
    }

    // 休憩戻
    public function breakEnd()
    {
        $userId = Auth::id();
        $today = Carbon::today()->toDateString();

        $attendance = Attendance::where('user_id', $userId)
            ->where('date', $today)
            ->first();

        if (!$attendance || $attendance->status !== 2) {
            return redirect()->route('attendance');
        }

        $break = BreakTime::where('attendance_id', $attendance->id)
            ->whereNull('break_end')
            ->latest()
            ->first();

        if ($break) {
            $break->update([
                'break_end' => Carbon::now(),
            ]);
        }

        $attendance->update([
            'status' => 1,
        ]);

        return redirect()->route('attendance');
    }

    // 退勤
    public function end()
{
    $userId = Auth::id();
    $today = Carbon::today()->toDateString();

    $attendance = Attendance::where('user_id', $userId)
        ->where('date', $today)
        ->first();

    if (!$attendance || !in_array($attendance->status, [1, 2])) {
        return redirect()->route('attendance');
    }

    if ($attendance->clock_out) {
        return redirect()->route('attendance');
    }

    $attendance->update([
        'clock_out' => Carbon::now(),
        'status' => 3, // 退勤済
    ]);

    // ★ ここを変更（完了画面へ遷移）
    return view('attendance.end');
}

    public function list($year, $month)
{
    $attendances = Attendance::where('user_id', auth()->id())
        ->whereYear('date', $year)
        ->whereMonth('date', $month)
        ->with('breakTimes')
        ->orderBy('date', 'asc')
        ->get();

    return view('attendance.list', compact('attendances', 'year', 'month'));
}

    public function detail($id)
{
    $attendance = Attendance::with('breakTimes')->findOrFail($id);

    return view('attendance.detail', compact('attendance'));
}
public function edit($id)
{
    $attendance = Attendance::with('breakTimes', 'user')->findOrFail($id);
    return view('attendance.edit', compact('attendance'));
}

public function update(Request $request, $id)
{
    $attendance = Attendance::findOrFail($id);

    $attendance->clock_in = $request->clock_in;
    $attendance->clock_out = $request->clock_out;
    $attendance->note = $request->note;
    $attendance->save();

    return redirect()->route('attendance.detail', $attendance->id)
                     ->with('success', '勤怠を更新しました');
}


}
