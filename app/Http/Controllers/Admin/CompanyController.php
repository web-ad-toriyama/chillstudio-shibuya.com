<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    public function index()
    {
        // データ取得
        $company = Company::first();

        return view('admin.company.index', compact('company'));
    }

    public function edit()
    {
        // データ取得
        $company = Company::first();

        return view('admin.company.edit', compact('company'));
    }

    public function postEdit(Request $request)
    {
        // データ更新処理
        try {
            // 入力データの取得
            $values = [
                'name' => $request->input('name'),
                'tel' => $request->input('tel'),
                'zip_code' => $request->input('zip_code'),
                'address' => $request->input('address'),
                'biz_hours' => $request->input('biz_hours'),
                'closed' => $request->input('closed'),
                'station_1' => $request->input('station_1'),
                'station_2' => $request->input('station_2'),
                'parking' => $request->input('parking'),
                'line' => $request->input('line'),
                'twitter' => $request->input('twitter'),
                'instagram' => $request->input('instagram'),
                'president' => $request->input('president'),
                'established' => $request->input('established'),
                'capital' => $request->input('capital'),
                'business' => $request->input('business'),
                'employees' => $request->input('employees'),
                'client' => $request->input('client'),
            ];

            // データ更新
            Company::updateOrCreate(['id' => 1], $values);
        } catch (Throwable $e) {
            Log::error($e);
            return redirect()->route('wb-admin.company.edit')->with('error_message', '会社情報の登録に失敗しました。');
        }
        return redirect()->route('wb-admin.company.index')->with('success_message', '会社情報の登録に成功しました。');
    }
}
