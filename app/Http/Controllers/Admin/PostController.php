<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Throwable;

class PostController extends Controller
{
    /**
     * 一覧画面表示
     *
     * @return void
     */
    public function index()
    {
        // データ取得
        $posts = Post::orderBy('published_at', 'DESC')->paginate(config('custom.paginate.admin'));

        return view('admin.post.index', compact('posts'));
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
            DB::beginTransaction();
            foreach ($request->input('del') as $id) {
                // 該当ディレクトリ削除
                Storage::disk('post')->deleteDirectory($id);
                // データ削除
                Post::destroy($id);
            }
            DB::commit();
        } catch (Throwable $e) {
            Log::error($e);
            DB::rollBack();
            return redirect()->route('wb-admin.post.index')->with('error_message', 'データの削除に失敗しました。');
        }

        return redirect()->route('wb-admin.post.index')->with('success_message', 'データの削除に成功しました。');
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
        $post = Post::find($id);
        $display = config('custom.display.on');
        if ($post->display ==  config('custom.display.on')) {
            $display = config('custom.display.off');
        }

        try {
            Post::where('id', $post->id)->update(['display' => $display]);
        } catch (Throwable $e) {
            Log::error($e);
            return redirect()->route('wb-admin.post.index', ['page'=>$request->get('page')])->with('error_message', '表示状態の変更に失敗しました。');
        }

        return redirect()->route('wb-admin.post.index', ['page'=>$request->get('page')])->with('success_message', '表示状態の変更に成功しました。');
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

        return view('admin.post.add', compact('published'));
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
            return redirect()->route('wb-admin.post.add')
                        ->withErrors($validator)
                        ->withInput();
        }
        // データ新規登録
        try {
            DB::beginTransaction();
            // バリデーション済みデータの取得
            $validated = $validator->validated();
            $validated['display'] = config('custom.display.on');
            $validated['published_at'] = $validated['published_date'].' '.$validated['published_time'];
            // 新規登録処理
            $post = Post::create($validated);
            // 画像アップロード
            Storage::disk('post')->makeDirectory($post->id);
            if (!is_null($request->file('file'))) {
                $path = $request->file('file')->store($post->id, 'post');
                Post::where('id', $post->id)->update(['file_path' => $path]);
            }
            DB::commit();
        } catch (Throwable $e) {
            Log::error($e);
            DB::rollBack();

            return redirect()->route('wb-admin.post.index')->with('error_message', '投稿の新規登録に失敗しました。');
        }

        return redirect()->route('wb-admin.post.index')->with('success_message', '投稿の新規登録に成功しました。');
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
        $post = Post::find($id);
        if ($post === null) {
            return redirect()->route('wb-admin.post.index')->with('error_message', '不適切なIDが設定されました。');
        }
        // 投稿日時作成
        $published['date'] = Carbon::parse($post->published_at)->format('Y-m-d');
        $published['time'] = Carbon::parse($post->published_at)->format('H:i');

        return view('admin.post.edit', compact('post', 'published'));
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
            return redirect()->route('wb-admin.post.edit', $id)
                        ->withErrors($validator)
                        ->withInput();
        }
        // データ更新処理
        try {
            DB::beginTransaction();
            // バリデーション済みデータの取得
            $validated = $validator->validated();
            $validated['published_at'] = $validated['published_date'].' '.$validated['published_time'];
            unset($validated['published_date'], $validated['published_time'], $validated['file']);
            if (!is_null($request->file('file'))) {
                // 画像アップロード
                $validated['file_path'] = $request->file('file')->store($id, 'post');
                // 旧ファイル削除
                Storage::disk('post')->delete($request->input('file_path'));
            } else {
                // 削除チェック
                if ($request->input('file_del') == 1) {
                    // 旧ファイル削除
                    Storage::disk('post')->delete($request->input('file_path'));
                    $validated['file_path'] = null;
                }
            }
            // データ更新
            Post::where('id', $id)->update($validated);
            DB::commit();
        } catch (Throwable $e) {
            Log::error($e);
            DB::rollBack();

            return redirect()->route('wb-admin.post.index')->with('error_message', '投稿の更新登録に失敗しました。');
        }

        return redirect()->route('wb-admin.post.index')->with('success_message', '投稿の更新登録に成功しました。');
    }

    /**
     * バリデーション実施
     *
     * @param Request $request
     * @return object
     */
    private function _validator(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'published_date' => 'required',
            'published_time' => 'required',
            'file' => 'nullable:file_path|file|image:jpeg,png,jpg,gif',
            'contents' => 'required',
        ]);

        return $validator;
    }
}
