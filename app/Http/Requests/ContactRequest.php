<?php

namespace App\Http\Requests;

use App\Models\Contact;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{

    protected $data;
    private $items;

    /**
     * クラスのコンストラクタ
     *
     * Contactモデルを使用してお問い合わせ項目を全件取得し、プロパティにセット
     */
    public function __construct()
    {
        $model = new Contact;
        $this->items = $model->getItems();
    }

    /**
     * リクエスト内容に対するバリデーションルール
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        foreach ($this->items as $item) {
            $rules[$item->name] = [];

            $rules[$item->name][] = $item->required;

            /*
             * 入力条件の指定がある場合
             */
            if ($item->option) {
                // custom.phpに設定されたルールの場合、ルールを取得して設定
                if (config('custom.contact.rules.' . $item->option)) {
                    foreach (config('custom.contact.rules.' . $item->option) as $option) {
                        $rules[$item->name][] = $option;
                    }

                // 入力一致確認(confirmation)の場合、ターゲットとなる項目にルールを設定
                } elseif (str_contains($item->option, 'confirmation')) {
                    // 入力条件が「XXXX_confirmation」の場合、「XXXX」を$targetに取得
                    $target = explode('_', $item->option)[0];

                    // $targetに対して、comfirmのルールを設定
                    $rules['contact_' . $target][] = config('custom.contact.rules.confirmation');
                } else {
                    $rules[$item->name][] = $item->option;
                }
            }

            // 最大文字数(最大値)の設定がある場合
            if ($item->max) {
                $rules[$item->name][] = 'max:' . $item->max;
            }

            // 最小文字数(最小値)の設定がある場合
            if ($item->min) {
                $rules[$item->name][] = 'min:' . $item->min;
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
        $attributes = [];
        foreach ($this->items as $item) {
            $attributes[$item->name] = $item->title;
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
        $messages = [];
        foreach ($this->items as $item) {
            // 選択入力の場合にエラーメッセージを変更
            if (in_array($item->format, ['radio', 'select', 'checkbox'], true)) {
                $messages[$item->name . '.required'] = ':attributeは必ず選択してください。';
            }
        }
        return $messages;
    }
}
