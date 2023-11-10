<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public $timestamps = true;

    /**
     *  マスアサインメントの保護を外す
     *
     * @var array プロパティ
     */
    protected $fillable = [
        'name',
        'title',
        'sequence',
        'required',
        'format',
        'select1',
        'select2',
        'select3',
        'select4',
        'select5',
        'option',
        'max',
        'min',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'format' => 'string'
    ];

    /**
     * 入力形式の定数を設定
     */
    const TEXT = 1;
    const TEXTAREA = 2;
    const SELECT = 3;
    const RADIO = 4;
    const CHECKBOX = 5;

    /**
     * 入力形式の配列を作成
     */
    protected $formats = [
        self::TEXT => 'text',
        self::TEXTAREA => 'textarea',
        self::SELECT => 'select',
        self::RADIO => 'radio',
        self::CHECKBOX => 'checkbox'
    ];

    /**
     * フォーマット属性を設定
     *
     * @param mixed $value
     * @return string|null 入力形式
     */
    public function getFormatAttribute($value)
    {
        return $this->formats[$value] ?? null;
    }

    /**
     * フォーマット属性を設定
     *
     * @param string $value 入力形式
     * @return void
     */
    public function setFormatAttribute($value)
    {
        $formats = array_flip($this->formats);
        $this->attributes['format']  = $formats[$value] ?? null;
    }

    /**
    * お問い合わせ項目の取得
    *
    * @return \Illuminate\Support\Collection 取得結果
    */
    public function getItems()
    {
        $items = Contact::select('id', 'name', 'title', 'display', 'edit_mode', 'required', 'format', 'select1', 'select2', 'select3', 'select4', 'select5', 'option', 'max', 'min')
        ->where('display', config('custom.display.on'))
        ->orderBy('sequence', 'DESC')
        ->get();

        foreach ($items as $item) {
            // デフォルト項目の場合、項目名をcustom.phpから取得
            if ($item->edit_mode !== config('custom.contact.edit_mode.custom')) {
                $item->title = config('custom.contact.default.' . $item->name);
            }

            // 入力が必須の場合はrequired、任意の場合はnullableに置換
            if ($item->required == true) {
                $item->required = 'required';
            } else {
                $item->required = 'nullable';
            }

            // 入力が選択形式の場合、設定されている選択肢をまとめて取得
            $select_item = collect(['radio', 'select', 'checkbox']);
            if ($select_item->contains($item->format)) {
                $item->options = collect([
                                        'select1' => $item->select1,
                                        'select2' => $item->select2,
                                        'select3' => $item->select3,
                                        'select4' => $item->select4,
                                        'select5' => $item->select5])
                                    ->filter()
                                    ->all();
            }
        }

        return $items;
    }
}
