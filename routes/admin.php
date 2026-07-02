<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\StaffController;

Route::middleware('auth:admin')->prefix('admin')->group(function () {

    // スタッフ一覧
    Route::get('/staff', [StaffController::class, 'index'])
        ->name('admin.staff.index');

    // スタッフ別勤怠一覧（年/月）
    Route::get('/staff/{id}/attendance/{year}/{month}', 
        [StaffController::class, 'attendance'])
        ->name('admin.staff.attendance');

    // CSV 出力
    Route::get('/staff/{id}/attendance/{year}/{month}/csv', 
        [StaffController::class, 'exportCsv'])
        ->name('admin.staff.attendance.csv');

    // 勤怠詳細（必要なら）
    Route::get('/attendance/{attendanceId}', 
        [StaffController::class, 'detail'])
        ->name('admin.attendance.detail');

});
