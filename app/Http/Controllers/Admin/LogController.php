<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    /**
     * お問合せログページ表示
     *
     * @return void
     */
    public function index()
    {
        // 表示限日
        $dt = new Carbon(date('Y-m-d'));
        $life_month = $dt->subMonthsNoOverflow(config('custom.log_life_month'))->format('Y-m-d');
        // お問合せログ取得
        $logs = Log::where('created_at', '>=', $life_month)->orderBy('created_at', 'DESC')->orderBy('id', 'DESC')->paginate(config('custom.paginate.admin'));

        return view('admin.log.index', compact('logs'));
    }
}
