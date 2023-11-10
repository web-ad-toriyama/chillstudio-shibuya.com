（このメールはお問い合わせ確認用に自動的に送信されています）

{{ $contact['contact_name'][config('custom.contact.default.contact_name')] }}様

この度は、弊社{{ $company['name'] }}にお問い合わせいただきまして、誠にありがとうございます。
このメールは、お問い合わせフォームからの送信が正しく完了したことをお知らせするものです。

以下の内容で受付いたしました。

------------------------------------------

@foreach ($contact as $item)
@foreach ($item as $key => $value)
[{{ $key }}] {{-- 項目名 ( 例:[お名前] ) --}}
@if (is_array($value))
{{ implode(',', $value) }} {{-- 内容 ( 例:選択肢1,選択肢2,選択肢3 ) --}}

@else
{{ $value }} {{-- 内容 ( 例:ウェヴァード太郎 ) --}}

@endif
@endforeach
@endforeach

------------------------------------------

担当者より順次ご連絡させていただきますので、よろしくお願いいたします。


□━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━□

{{ $company['name'] }}
〒{{ $company['zip_code'] }}　{{ $company['address'] }}
TEL：{{ $company['tel'] }}

HP:{{ env('APP_URL') }}

□━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━□
