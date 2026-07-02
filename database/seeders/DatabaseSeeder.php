<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ▼ 管理者ユーザー（このまま残す）
        Admin::create([
            'name' => '管理者 太郎',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        // ▼ 一般ユーザー（UserSeeder から呼び出す）
        $this->call(UserSeeder::class);

        // ▼ 勤怠データ（AttendanceSeeder から呼び出す）
        $this->call(AttendanceSeeder::class);
    }
}
