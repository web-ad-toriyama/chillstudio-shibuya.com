<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class NoticeController extends Controller
{
    /**
     * 運営部からのお知らせページ表示
     *
     * @return void
     */
    public function index()
    {
        // 運営部からのお知らせ取得
        $notices = DB::connection('mysql_notice')
        ->table('notices')
        ->where('published_at', '<=', Carbon::now())
        ->orderBy('published_at', 'DESC')
        ->orderBy('id', 'DESC')
        ->paginate(config('custom.paginate.admin'));

        // 新着有効期限日
        $dt = new Carbon(date('Y-m-d'));
        $new_date = $dt->subDays(config('custom.new_life_days'))->format('Y-m-d');

        return view('admin.notice.index', compact('notices', 'new_date'));
    }
}
