<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Log as ModelsLog;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactShipped;
use App\Mail\ContactCompleted;

class ContactController extends Controller
{
    private $items;

    public function __construct()
    {
        $model = new Contact;
        $this->items = $model->getItems();
    }

    /**
     * お問い合わせ入力画面
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('contact', ['items' => $this->items]);
    }

    /**
     * お知らせ確認画面
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function confirm(ContactRequest $request)
    {
        $requirement = $request['contact_requirement'];
        if ($requirement) {
            $request['contact_requirement'] = config('custom.icon.requirement.' . $requirement);
        }

        return view('contact_confirm', ['request' => $request, 'items' => $this->items]);
    }

    /**
     * お問い合わせ送信処理
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function send(Request $request)
    {
        // 二重送信対策
        $request->session()->regenerateToken();

        $values = [];

        foreach ($this->items as $item) {
            // メールアドレス確認を除いた項目を配列に取得
            if ($item->name !== 'contact_email_confirmation') {
                $values[$item->name] = [
                    $item->title => $request->input($item->name)
                ];
            }
        }

        // Mailable オブジェクトを生成してから body の取得まで
        $mailable = new ContactShipped($values);
        $mailable->build();
        $render = $mailable->render();

        $log = [
            'name' => $request->input('contact_name'),
            'email' => $request->input('contact_email'),
            'contents' => $render,
            'created_at' => now(),
            'updated_at' => now()
        ];

        // ログデータ書き込み
        ModelsLog::create($log);

        // お問い合わせメール送信実行
        Mail::send($mailable);

        // 控えメール送信
        Mail::send(new ContactCompleted($values));

        return view('contact_send');
    }

    /**
     * エラー処理
     *
     * @return void
     */
    public function error()
    {
        // 直接URLを叩いて確認画面や送信完了画面に入った場合、エラーとする。
        return redirect()->route(config('custom.page.contact.route'));
    }
}
