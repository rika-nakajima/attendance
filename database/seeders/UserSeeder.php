<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            ['name' => '山田 太郎', 'email' => 'taro@example.com'],
            ['name' => '佐藤 花子', 'email' => 'hanako@example.com'],
            ['name' => '鈴木 次郎', 'email' => 'jiro@example.com'],
            ['name' => '田中 美咲', 'email' => 'misaki@example.com'],
            ['name' => '高橋 健', 'email' => 'ken@example.com'],
        ];

        foreach ($users as $u) {
            User::create([
                'name' => $u['name'],
                'email' => $u['email'],
                'password' => Hash::make('password'),
                'role' => 'user',
            ]);
        }
    }
}
