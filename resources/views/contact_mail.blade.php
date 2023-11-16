お名前：{{ $contact['contact_name'] }}
予約希望日：
@for($i=1; $i<=$contact['day_count'];$i++)
{{ $contact['contact_day'.$i] }}:{{ $contact['contact_start'.$i] }}時から{{ $contact['contact_time'.$i] }}時間
@endfor
メールアドレス：{{ $contact['contact_email'] }}
電話番号：{{ $contact['contact_tel'] }}
郵便番号：{{ $contact['post_code'] }}
住所：{{ $contact['contact_address'] }}
お問合せ用件：{{ $contact['contact_requirement'] }}
お問合せ内容：{{ $contact['contact_contents'] }}
