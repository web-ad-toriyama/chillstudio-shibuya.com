<?php

namespace App\Http\Controllers;

use App\Models\News;
use Carbon\Carbon;

class Category6Controller extends Controller
{
    /**
     * お知らせ一覧ページ
     *
     * @return void
     */
    public function index()
    {
        // お知らせ一覧取得
        $news = News::where('display', config('custom.display.on'))
                    ->where('published_at', '<=', Carbon::now())
                    ->orderBy('published_at', 'DESC')
                    ->orderBy('id', 'DESC')
                    ->paginate(config('custom.paginate.news'));

        return view('category6', compact('news'));
    }

    /**
     * お知らせ詳細ページ
     *
     * @param integer $id
     * @return void
     */
    public function detail(int $id)
    {
        // 該当の投稿取得
        $news = News::find($id);

        // 非表示の場合は404エラーに
        if($news->display == config('custom.display.off')) abort(404);

        return view('category6_detail', compact('news'));
    }
}
