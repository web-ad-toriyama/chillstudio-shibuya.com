<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminContactRequest extends FormRequest
{

    protected $data;

    /**
     * リクエスト内容に対するバリデーションルール
     *
     * @return array
     */
    public function rules()
    {
        if ($this->routeIsAdd()) {
            $rules = [
                'title.*' => 'required',
                'required.*' => 'required',
                'format.*' => 'required',
                'min.*' => 'nullable|numeric|between:0,2000'
            ];
            $num = count($this->input('title', []));
            for ($i = 0; $i < $num; $i++) {
                $rules["select1.$i"] = "required_if:format.$i,radio,select,checkbox";
                $rules["select2.$i"] = "required_if:format.$i,radio,select,checkbox";
                $rules["max.$i"] = "nullable|numeric|gte:min.$i|min:1|lte:2000";
            }
        } else {
            // デフォルト項目はrequiredのみ必須
            if ($this->checkEditMode()) {
                $rules = [
                    'title' => 'required',
                    'required' => 'required',
                    'format' => 'required',
                    'select1' => 'required_if:format,radio,select,checkbox',
                    'select2' => 'required_if:format,radio,select,checkbox',
                    'max' => 'nullable|numeric|gte:min|min:1|lte:2000',
                    'min' => 'nullable|numeric|between:0,2000'
                ];
            } else {
                $rules = ['required' => 'required'];
            }
        }

        return $rules;
    }

    /**
     * バリデーションエラー時の項目名
     *
     * @return array
     */
    public function attributes()
    {
        if ($this->routeIsAdd()) {
            $attributes = [
                'title.*' => '項目名',
                'required.*' => '入力',
                'format.*' => '入力形式',
                'max.*' => '最大文字数(最大値)',
                'min.*' => '最小文字数(最小値)'
            ];
        } else {
            $attributes = [
                'title' => '項目名',
                'required' => '入力',
                'format' => '入力形式',
                'max' => '最大文字数(最大値)',
                'min' => '最小文字数(最小値)'
            ];
        }

        return $attributes;
    }

    /**
     * バリデーションエラーのエラーメッセージ
     *
     * @return array
     */
    public function messages()
    {
        if ($this->routeIsAdd()) {
            $messages =  [
                '*.*.required_if' => '選択形式の場合、必ず入力してください。',
                '*.*.gte' => ':valueより大きい値を設定してください。',
            ];
        } else {
            $messages =  [
                '*.required_if' => '選択形式の場合、必ず入力してください。',
                '*.gte' => ':valueより大きい値を設定してください。',
            ];
        }
        return $messages;
    }

    /**
     * リクエスト元が追加画面か編集画面かを判別
     *
     * @return boolean
     */
    private function routeIsAdd()
    {
        return $this->routeIs('wb-admin.contact.postAdd');
    }

    /**
     * 入力項目が編集モードを判別
     * edit_mode = 0 (全項目の編集が可能)の場合のみ、trueを返却
     *
     * @return boolean
     */
    private function checkEditMode()
    {
        return $this->input('edit_mode') == config('custom.contact.edit_mode.custom');
    }
}
