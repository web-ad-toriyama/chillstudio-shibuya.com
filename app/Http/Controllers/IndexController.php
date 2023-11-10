<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Post;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function index()
    {
        // 投稿一覧取得
        $posts = Post::where('display', config('custom.display.on'))
                    ->where('published_at', '<=', Carbon::now())
                    ->orderBy('published_at', 'DESC')
                    ->orderBy('id', 'DESC')
                    ->limit(config('custom.limit.post'))
                    ->get();

        // お知らせ一覧取得
        $news = News::where('display', config('custom.display.on'))
                    ->where('published_at', '<=', Carbon::now())
                    ->orderBy('published_at', 'DESC')
                    ->orderBy('id', 'DESC')
                    ->limit(config('custom.limit.news'))
                    ->get();

        return view('index', compact('posts', 'news'));
    }
}
