<?php

namespace App\Http\Controllers;

use App\Mail\ContactCompleted;
use App\Models\Log as ModelsLog;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactShipped;

class ContactController extends Controller
{
    public function index()
    {
        session()->forget('image');
        return view('contact');
    }

    public function confirm(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
//            'contact_shop_name' => 'required',
            'contact_name' => 'required',
            'contact_email' => 'required|confirmed',
            'contact_email_confirmation' => 'required',
            'contact_tel' => 'required',
            'post_code' => 'required',
            'contact_address' => 'required',
            'contact_requirement' => 'required',
//            'contact_contents' => 'required',

        ]);
        if ($validator->fails()) {
            return redirect()->route(config('custom.page.contact.route'))
                ->withErrors($validator)
                ->withInput();
        }
        // バリデーション済みデータの取得
        $validated = $validator->validated();

        return view('contact_confirm', compact('validated', 'request'));
    }

    public function send(Request $request)
    {
        // 二重送信対策
        $request->session()->regenerateToken();
        $values = [
            'requirement'   => 1,
            'contact_name'  => $request->input('contact_name'),
            'day_count'     => $request->input('day_count'),
            'contact_email' => $request->input('contact_email'),
            'contact_tel'   => $request->input('contact_tel'),
            'post_code'   => $request->input('post_code'),
            'contact_address'     => $request->input('contact_address'),
            'contact_requirement' => $request->input('contact_requirement'),
            'contact_contents' => $request->input('contact_contents'),
        ];
        for($i=1; $i<=$request->input('day_count');$i++){
            $values['contact_day'.$i] = $request->input('contact_day'.$i);
            $values['contact_start'.$i] = $request->input('contact_start'.$i);
            $values['contact_time'.$i] = $request->input('contact_time'.$i);
        }

        // Mailable オブジェクトを生成
        $mailable = new ContactShipped($values);

        // メールの作成
        $mailable->build($values);

        // メールの本文を取得
        $render = $mailable->render();

        // メール送信を実行
        Mail::send($mailable);

        // 控えメール送信実行
//        Mail::send(new ContactCompleted($values));

//        // ログデータ書き込み
        ModelsLog::create([
            'requirement' => $values['requirement'],
            'name' => $values['contact_name'],
            'email' => $values['contact_email'],
            'contents' => $render,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return view('contact_send');
    }

    public function userIndex()
    {
        return view('contact2');
    }

    public function userConfirm(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'contact_name' => 'required',
            'contact_email' => 'required',
            'contact_contents' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route(config('custom.page.contact2.route'))
                ->withErrors($validator)
                ->withInput();
        }
        // バリデーション済みデータの取得
        $validated = $validator->validated();

        return view('contact2_confirm', compact('validated'));
    }

    public function userSend(Request $request)
    {
        // 二重送信対策
        $request->session()->regenerateToken();

        $values = [
            'requirement' => 2,
            'contact_name' => $request->input('contact_name'),
            'contact_email' => $request->input('contact_email'),
            'contact_tel' => $request->input('contact_tel'),
            'post_code' => $request->input('post_code'),
            'contact_address' => $request->input('contact_address'),
            'contact_requirement' => $request->input('contact_requirement'),
            'contact_contents' => $request->input('contact_contents'),
        ];

        // Mailable オブジェクトを生成してから body の取得まで
        $mailable = new ContactShipped($values);
        $mailable->build($values);
        $render = $mailable->render();

        // ログデータ書き込み
        ModelsLog::create([
            'requirement' => $values['requirement'],
            'name' => $values['contact_name'],
            'contents' => $render,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // メール送信実行
        Mail::send($mailable);

        // 控えメール送信実行
        Mail::send(new ContactCompleted($values));

        return view('contact_send');
    }

    public function error()
    {
        // 直接URLを叩いて確認画面や送信完了画面に入った場合、エラーとする。
        return redirect()->route(config('custom.page.contact.route'));
    }
}
