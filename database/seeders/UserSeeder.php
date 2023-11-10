<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 登録済みのユーザーデータを削除
        // User::truncate();

        // テストユーザー
        DB::table('users')->insert([
            'name' => 'ウェヴァード太郎',
            'email' => 'test@web-ad.co.jp',
            'password' => bcrypt('webad'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
