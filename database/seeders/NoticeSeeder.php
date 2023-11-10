<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class NoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dt = new Carbon('2022-01-01');

        for ($i=1; $i<20; $i++) {
            // テストデータ
            DB::table('notices')->insert([
                'published_at' => $dt->addDays($i),
                'icon' => 1,
                'title' => 'テストデータ'.$i,
                'contents' => '内容'.$i,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
