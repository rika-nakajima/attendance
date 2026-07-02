<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        // ここではまだダミーデータを返すだけ
        $applications = [
            [
                'status' => '承認待ち',
                'name' => '百百香',
                'date' => '2023/06/01',
                'reason' => '遅延のため',
                'applied_at' => '2023/06/02',
            ],
            [
                'status' => '承認待ち',
                'name' => '百百香',
                'date' => '2023/06/02',
                'reason' => '遅延のため',
                'applied_at' => '2023/06/02',
            ],
        ];

        return view('application.index', compact('applications'));
    }
    public function detail($id)
{
    $app = Application::with('attendance', 'user')->findOrFail($id);

    return view('admin.application.detail', compact('app'));
}

public function approve($id)
{
    $app = Application::with('attendance')->findOrFail($id);

    // ① 勤怠情報を更新
    $attendance = $app->attendance;
    $attendance->update([
        'clock_in' => $app->new_clock_in,
        'clock_out' => $app->new_clock_out,
        'note' => $app->new_note,
    ]);

    // ② 申請ステータスを更新
    $app->update(['status' => 'approved']);

    // ③ 承認済みタブへ戻る
    return redirect()->route('admin.application.index', ['tab' => 'approved'])
                     ->with('success', '申請を承認しました');
}

}
