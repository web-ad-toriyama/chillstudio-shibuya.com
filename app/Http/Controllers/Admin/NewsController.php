<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Throwable;

class NewsController extends Controller
{
    /**
     * 一覧画面表示
     *
     * @return void
     */
    public function index()
    {
        // データ取得
        $news = News::orderBy('published_at', 'DESC')->orderBy('id', 'DESC')->paginate(config('custom.paginate.admin'));

        return view('admin.news.index', compact('news'));
    }

    /**
     * データ削除処理
     *
     * @param Request $request
     * @return void
     */
    public function postIndex(Request $request)
    {
        try {
            foreach ($request->input('del') as $id) {
                // データ削除
                News::destroy($id);
            }
        } catch (Throwable $e) {
            Log::error($e);
            return redirect()->route('wb-admin.news.index')->with('error_message', 'データの削除に失敗しました。');
        }

        return redirect()->route('wb-admin.news.index')->with('success_message', 'データの削除に成功しました。');
    }

    /**
     * 表示切り替え処理
     *
     * @param Request $request
     * @param integer $id
     * @return void
     */
    public function display(Request $request, int $id)
    {
        $post = News::find($id);
        $display = config('custom.display.on');
        if ($post->display ==  config('custom.display.on')) {
            $display = config('custom.display.off');
        }

        try {
            News::where('id', $post->id)->update(['display' => $display]);
        } catch (Throwable $e) {
            Log::error($e);
            return redirect()->route('wb-admin.news.index', ['page'=>$request->get('page')])->with('error_message', '表示状態の変更に失敗しました。');
        }

        return redirect()->route('wb-admin.news.index', ['page'=>$request->get('page')])->with('success_message', '表示状態の変更に成功しました。');
    }

    /**
     * 登録画面表示
     *
     * @return void
     */
    public function add()
    {
        // 投稿日時作成
        $published['date'] = Carbon::now()->format('Y-m-d');
        $published['time'] = Carbon::now()->format('H:i');

        return view('admin.news.add', compact('published'));
    }

    /**
     * 新規登録処理
     *
     * @param Request $request
     * @return void
     */
    public function postAdd(Request $request)
    {
        // バリデーション
        $validator = $this->_validator($request);
        if ($validator->fails()) {
            return redirect()->route('wb-admin.news.add')
                        ->withErrors($validator)
                        ->withInput();
        }
        // データ新規登録
        try {
            // バリデーション済みデータの取得
            $validated = $validator->validated();
            $validated['display'] = config('custom.display.on');
            $validated['published_at'] = $validated['published_date'].' '.$validated['published_time'];
            // 新規登録処理
            $post = News::create($validated);
        } catch (Throwable $e) {
            Log::error($e);
            return redirect()->route('wb-admin.news.index')->with('error_message', 'お知らせの新規登録に失敗しました。');
        }

        return redirect()->route('wb-admin.news.index')->with('success_message', 'お知らせの新規登録に成功しました。');
    }

    /**
     * 編集画面表示
     *
     * @param integer $id
     * @return void
     */
    public function edit(int $id)
    {
        // 該当データ取得
        $news = News::find($id);
        if ($news === null) {
            return redirect()->route('wb-admin.news.index')->with('error_message', '不適切なIDが設定されました。');
        }
        // 投稿日時作成
        $published['date'] = Carbon::parse($news->published_at)->format('Y-m-d');
        $published['time'] = Carbon::parse($news->published_at)->format('H:i');

        return view('admin.news.edit', compact('news', 'published'));
    }

    /**
     * 更新処理
     *
     * @param Request $request
     * @param integer $id
     * @return void
     */
    public function postEdit(Request $request, int $id)
    {
        // バリデーション
        $validator = $this->_validator($request);
        if ($validator->fails()) {
            return redirect()->route('wb-admin.news.edit', $id)
                        ->withErrors($validator)
                        ->withInput();
        }
        // データ更新処理
        try {
            // バリデーション済みデータの取得
            $validated = $validator->validated();
            $validated['published_at'] = $validated['published_date'].' '.$validated['published_time'];
            unset($validated['published_date'], $validated['published_time'], $validated['file']);
            // データ更新
            News::where('id', $id)->update($validated);
        } catch (Throwable $e) {
            Log::error($e);
            return redirect()->route('wb-admin.news.index')->with('error_message', 'お知らせの更新登録に失敗しました。');
        }

        return redirect()->route('wb-admin.news.index')->with('success_message', 'お知らせの更新登録に成功しました。');
    }

    /**
     * バリデーション実施
     *
     * @param Request $request
     * @return Object
     */
    private function _validator(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'icon' => 'required',
            'title' => 'required',
            'published_date' => 'required',
            'published_time' => 'required',
            'contents' => 'required',
        ]);

        return $validator;
    }
}
