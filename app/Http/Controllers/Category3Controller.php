<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;

class Category3Controller extends Controller
{
    /**
     * 投稿一覧ページ
     *
     * @return void
     */
    public function index()
    {
        // 投稿一覧取得
        $posts = Post::where('display', config('custom.display.on'))
                    ->where('published_at', '<=', Carbon::now())
                    ->orderBy('published_at', 'DESC')
                    ->orderBy('id', 'DESC')
                    ->paginate(config('custom.paginate.post'));

        return view('category3', compact('posts'));
    }

    /**
     * 投稿詳細ページ
     *
     * @param integer $id
     * @return void
     */
    public function detail(int $id)
    {
        // 最新の投稿取得
        $posts = Post::where('display', config('custom.display.on'))
        ->where('published_at', '<=', Carbon::now())
        ->orderBy('published_at', 'DESC')
        ->orderBy('id', 'DESC')
        ->paginate(config('custom.limit.post_latest'));

        // 該当の投稿取得
        $post = Post::find($id);

        // 非表示の場合は404エラーに
        if($post->display == config('custom.display.off')) abort(404);

        return view('category3_detail', compact('post', 'posts'));
    }
}
