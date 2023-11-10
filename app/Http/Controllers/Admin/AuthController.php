<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * ログイン画面表示
     *
     * @return void
     */
    public function login()
    {
        // ログイン状態の場合、管理画面にリダイレクトさせる
        if (Auth::check()) {
            return redirect()->route('wb-admin.dashboard');
        }
        return view('admin.login');
    }

    /**
     * ログイン処理
     *
     * @param Request $request
     * @return void
     */
    public function postLogin(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('login')
                        ->withErrors($validator)
                        ->withInput();
        }
        // 認証処理
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('wb-admin.dashboard');
        }
        return back()->withErrors([
            'email' => 'ログインに失敗しました。',
        ]);
    }

    /**
     * ログアウト処理
     *
     * @param Request $request
     * @return void
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
