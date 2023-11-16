（このメールはお問い合わせ確認用に自動的に送信されています）

{{ $contact['contact_name']}}様

この度は、弊社{{ $company['name'] }}にお問い合わせいただきまして、誠にありがとうございます。
このメールは、お問い合わせフォームからの送信が正しく完了したことをお知らせするものです。

以下の内容で受付いたしました。

------------------------------------------

お名前：{{ $contact['contact_name'] }}
@for($i=1; $i<=$contact['day_count'];$i++)
    {{ $contact['contact_day'.$i] }}:{{ $contact['contact_start'.$i] }}時から{{ $contact['contact_time'.$i] }}時間
@endfor
メールアドレス：{{ $contact['contact_email'] }}
電話番号：{{ $contact['contact_tel'] }}
郵便番号：{{ $contact['post_code'] }}
住所：{{ $contact['contact_address'] }}
お問合せ用件：{{ $contact['contact_requirement'] }}
お問合せ内容：{{ $contact['contact_contents'] }}



------------------------------------------

担当者より順次ご連絡させていただきますので、よろしくお願いいたします。


□━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━□

{{ $company['name'] }}
〒{{ $company['zip_code'] }}　{{ $company['address'] }}
TEL：{{ $company['tel'] }}

HP:{{ env('APP_URL') }}

□━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━□
