<?php

use Illuminate\Support\Facades\Route;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Admin\AdminLoginController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ★ ログイン画面（Fortify は使わない）
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// ★ トップページ
Route::get('/', function () {
    return view('welcome');
});

// ★ 申請ページ（ログイン不要）
Route::get('/application', [ApplicationController::class, 'index'])
    ->name('application');

// ★ ログイン処理（独自バリデーション）
Route::post('/login', function (LoginRequest $request) {

    $credentials = $request->validated();

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect('/attendance');
    }

    return back()->withErrors([
        'email' => 'メールアドレスまたはパスワードが正しくありません。',
    ]);
})->name('login.post');

// ★ 新規登録処理（独自バリデーション）
Route::post('/register', function (RegisterRequest $request) {

    $data = $request->validated();

    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'role' => 'user',
    ]);

    Auth::login($user);

    return redirect('/attendance');

})->name('register');

// ★ 新規登録画面
Route::get('/register', function () {
    return view('auth.register');
})->name('register.form');

// ★ ログイン必須のページ（一般ユーザー）
Route::middleware(['auth'])->group(function () {

    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance');

    Route::post('/attendance/start', [AttendanceController::class, 'start'])->name('attendance.start');

    Route::post('/attendance/break/start', [AttendanceController::class, 'breakStart'])->name('attendance.break.start');

    Route::post('/attendance/break/end', [AttendanceController::class, 'breakEnd'])->name('attendance.break.end');

    Route::post('/attendance/end', [AttendanceController::class, 'end'])->name('attendance.end');

    Route::get('/attendance/{id}', [AttendanceController::class, 'detail'])->name('attendance.detail');

    Route::get('/attendance/list/{year}/{month}', [AttendanceController::class, 'list'])->name('attendance.list');

    Route::get('/attendance/{id}/edit', [AttendanceController::class, 'edit'])->name('attendance.edit');

    Route::post('/attendance/{id}/update', [AttendanceController::class, 'update'])->name('attendance.update');

});

/// ★ 管理者用ルート
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [AdminLoginController::class, 'login'])
        ->name('login.post');

    Route::middleware('auth:admin')->group(function () {

        // 勤怠一覧
        Route::get('/attendance', [\App\Http\Controllers\Admin\AttendanceController::class, 'index'])
            ->name('attendance.index');

        // 勤怠詳細
        Route::get('/attendance/{id}', [\App\Http\Controllers\Admin\AttendanceController::class, 'detail'])
            ->name('attendance.detail');

        // 勤怠修正
        Route::put('/attendance/{id}', [\App\Http\Controllers\Admin\AttendanceController::class, 'update'])
            ->name('attendance.update');

        // スタッフ別勤怠一覧
        Route::get('/staff/{id}/attendance/{year}/{month}',
            [\App\Http\Controllers\Admin\StaffController::class, 'attendance']
        )->name('staff.attendance');

        // スタッフ一覧
        Route::get('/staff', [\App\Http\Controllers\Admin\StaffController::class, 'index'])
            ->name('staff.index');

        // 修正申請一覧
        Route::get('/application', [\App\Http\Controllers\Admin\ApplicationController::class, 'index'])
            ->name('application.index');

        // ログアウト
        Route::post('/logout', function () {
            Auth::guard('admin')->logout();
            return redirect('/admin/login');
        })->name('logout');
    });

});





