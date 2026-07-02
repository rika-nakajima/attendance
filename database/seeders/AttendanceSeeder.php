<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $today = Carbon::today();

        // 過去3ヶ月分
        for ($i = 0; $i < 90; $i++) {
            $date = $today->copy()->subDays($i);

            foreach ($users as $user) {
                Attendance::create([
                    'user_id' => $user->id,
                    'date' => $date->format('Y-m-d'),
                    'clock_in' => '09:00:00',
                    'break_start' => '12:00:00',
                    'break_end' => '13:00:00',
                    'clock_out' => '18:00:00',
                    'note' => '自動生成データ',
                    'status' => 1, // 承認済み
                ]);
            }
        }
    }
}
