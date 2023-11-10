<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * 一覧画面表示
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // データ取得
        $contacts = Contact::orderby('sequence', 'DESC')->get();

        return view('admin.contact.index', compact('contacts'));
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
                // データ削除
                Contact::destroy($id);
            }
            DB::commit();
        } catch (Throwable $e) {
            Log::error($e);
            return redirect()->route('wb-admin.contact.index')->with('error_message', 'データの削除に失敗しました。');
        }

        return redirect()->route('wb-admin.contact.index')->with('success_message', 'データの削除に成功しました。');
    }

    /**
     * 表示切り替え処理
     *
     * @param Request $request
     * @param integer $id
     * @return void
     */
    public function display(int $id)
    {
        $contact = Contact::find($id);
        $display = config('custom.display.on');
        if ($contact->display ==  config('custom.display.on')) {
            $display = config('custom.display.off');
        }

        try {
            Contact::where('id', $contact->id)->update(['display' => $display]);
        } catch (Throwable $e) {
            Log::error($e);
            return redirect()->route('wb-admin.contact.index')->with('error_message', '表示状態の変更に失敗しました。');
        }

        return redirect()->route('wb-admin.contact.index')->with('success_message', '表示状態の変更に成功しました。');
    }

    /**
     * 登録画面表示
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function add()
    {
        return view('admin.contact.add');
    }

    /**
     * 新規登録処理
     *
     * @param AdminContactRequest $request
     * @return void
     */
    public function postAdd(AdminContactRequest $request)
    {
        // 二重送信対策
        $request->session()->regenerateToken();

        $validated = $request->validated();

        // データ新規登録
        try {
            DB::beginTransaction();

            // 項目数をカウントし、1件ずつ登録を実行
            for ($i = 0; $i < count($validated['title']); $i++) {
                $value = [
                    'title' => $validated['title'][$i],
                    'sequence' => 1,
                    'required' => $validated['required'][$i],
                    'format' => $validated['format'][$i],
                    'select1' => $validated['select1'][$i],
                    'select2' => $validated['select2'][$i],
                    'select3' => $request->input('select3.' . $i),
                    'select4' => $request->input('select4.' . $i),
                    'select5' => $request->input('select5.' . $i),
                    'select5' => $request->input('select5.' . $i),
                    'option' => $request->input('option.' . $i),
                    'max' => $validated['max'][$i],
                    'min' => $validated['min'][$i],
                    'created_at' => now(),
                    'updated_at' => now()
                ];

                $contact = new Contact();
                $contact->fill($value);
                $contact->save();

                // 登録したデータのidを元に、name(オフィシャルのフォームで利用するname属性)を設定
                $id = $contact->id;

                $contact->name = 'contact_custom_item' . $id;
                $contact->save();
            };

            DB::commit();
        } catch (Throwable $e) {
            Log::error($e);
            DB::rollBack();

            return redirect()->route('wb-admin.contact.index')->with('error_message', 'お問い合わせ項目の新規登録に失敗しました。');
        }

        return redirect()->route('wb-admin.contact.index')->with('success_message', 'お問い合わせ項目の新規登録に成功しました。');
    }

    /**
     * 編集画面表示
     *
     * @param integer $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(int $id)
    {
        // データ取得
        $contact = Contact::find($id);
        if ($contact === null) {
            return redirect()->route('wb-admin.contact.index')->with('error_message', '不適切なIDが設定されました。');
        }

        return view('admin.contact.edit', compact('contact'));
    }

    /**
     * 更新処理
     *
     * @param AdminContactRequest $request
     * @param integer $id
     * @return void
     */
    public function postEdit(AdminContactRequest $request, int $id)
    {
        // データ更新処理
        try {
            // 入力データの取得
            $value = $request->validated();

            // バリデーションルールが設定されていない項目の入力値を取得
            $value['select3'] = $request->input('select3');
            $value['select4'] = $request->input('select4');
            $value['select5'] = $request->input('select5');
            $value['option'] = $request->input('option');

            $contact = Contact::find($id);
            $contact->fill($value);
            $contact->update();
        } catch (Throwable $e) {
            Log::error($e);
            return redirect()->route('wb-admin.contact.edit')->with('error_message', 'お問い合わせ項目の編集に失敗しました。');
        }
        return redirect()->route('wb-admin.contact.index')->with('success_message', 'お問い合わせ項目の編集に成功しました。');
    }

    /**
     * 並び替え画面表示
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function sort()
    {
        // データ取得
        $contacts = Contact::orderBy('sequence', 'DESC')->get();

        return view('admin.contact.sort', compact('contacts'));
    }

    /**
     * 並び替え実施
     *
     * @param Request $request
     * @return void
     */
    public function postSort(Request $request)
    {
        if ($request->input('id') == null) {
            return redirect()->route('wb-admin.contact.index')->with('error_message', 'データの並び替えが行われていません。');
        }

        $index = count($request->input('id'));

        try {
            DB::beginTransaction();
            foreach ($request->input('id') as $id) {
                Contact::where('id', $id)->update(['sequence' => $index]);
                $index--;
            }
            DB::commit();
        } catch (Throwable $e) {
            Log::error($e);
            DB::rollBack();
            return redirect()->route('wb-admin.contact.index')->with('error_message', 'データの並び替えに失敗しました。');
        }

        return redirect()->route('wb-admin.contact.index')->with('success_message', 'データの並び替えに成功しました。');
    }
}
