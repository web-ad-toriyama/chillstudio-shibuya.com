<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index()
    {
        // 全てのルートを取得
        $routes = $this->getAllRoutes();

        // ページ情報を取得
        $pages = $this->getPages($routes);

        // custom.phpの情報を取得
        $config_pages = $this->getAllPageInfomations();

        return view('admin.page.index', compact('pages', 'config_pages'));
    }

    public function postIndex(Request $request)
    {
        // 選択されたページのルートを取得
        $routes = $request['route'];

        // ページ情報を取得
        $index = null;

        if (in_array('all', $routes, true)) {
            // 全てのルートを対象に変更
            $routes = $this->getAllRoutes();
        } elseif (!in_array('index', $routes, true)) {
            // indexページの情報を取得
            $index = Page::where('name', 'index')->first();
        }
        // ページ情報のデータを取得
        $pages = $this->getPages($routes);

        // データからnameカラムの値を抽出して配列に詰め替え
        $names = $pages->pluck('name')->toArray();

        // 登録データと入力データを比較
        $add_pages = array_diff($routes, $names);

        // 登録データのないページのnameを配列に追加
        foreach ($add_pages as $page) {
            $pages->push(['name' => $page]);
        }

        // custom.phpの情報を取得
        $config_pages = $this->getAllPageInfomations();

        return view('admin.page.edit', compact('pages', 'index', 'config_pages'));
    }

    public function edit(Request $request, int $id = null)
    {
        $pages = null;
        $index = null;

        // ページ情報の登録がある場合、データを取得
        if ($id) {
            $pages = Page::where('id', $id)->get();
        }

        // 選択されたページがindexでない場合、indexページの情報を取得
        if ($pages[0]['name'] !== 'index') {
            $index = Page::where('name', 'index')->first();
        }

        // custom.phpの情報を取得
        $config_pages = $this->getAllPageInfomations();

        return view('admin.page.edit', compact('pages', 'index', 'config_pages'));
    }

    public function postEdit(Request $request)
    {
        $pages = $request->except('_token');
        $values = [];
        foreach ($pages as $page) {
            $values[] = $page;
        }
        // データ更新処理
        try {
            DB::beginTransaction();
            // データ更新
            Page::upsert($values, 'name');
            DB::commit();
        } catch (Throwable $e) {
            Log::error($e);
            DB::rollBack();
            return redirect()->route('wb-admin.page.index')->with('error_message', 'ページ情報の更新登録に失敗しました。');
        }
        return redirect()->route('wb-admin.page.index')->with('success_message', 'ページ情報の更新登録に成功しました。');
    }

    public function error()
    {
        // 直接URLを叩いて確認画面や送信完了画面に入った場合、エラーとする。
        return redirect()->route('wb-admin.page.index');
    }

    // custom.phpに記載のあるルートをすべて取得
    public function getAllRoutes()
    {
        foreach (config('custom.page') as $page) {
            $routes[] = $page['route'];
        }

        return $routes;
    }

    // custom.phpのrouteの値からnameを呼び出すための配列を取得
    public function getAllPageInfomations()
    {
        foreach (config('custom.page') as $page) {
            $config_pages[$page['route']] = $page['name'];
        }

        return $config_pages;
    }

    public function getPages($routes)
    {
        // custom.phpの順に並び替えるために、クエリのplaceholderを作成
        $placeholder = '';
        foreach ($routes as $index => $value) {
            $placeholder .= ($index === 0) ? '?' : ',?';
        }

        // ページ情報をデータベースから取得
        $pages = Page::whereIn('name', $routes)->orderByRaw("FIELD(name, $placeholder)", $routes)->get();

        return $pages;
    }
}
