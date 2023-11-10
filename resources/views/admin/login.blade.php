<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex,nofollow">
	<meta name="format-detection" content="telephone=no">
	<meta name='viewport' content="width=device-width, initial-scale=1, viewport-fit=cover">
	
    <title>ホームページ管理システム</title>

	{{-- css --}}
	<link rel="stylesheet" href="{{ url('admin/css/destyle.css') }}">
	<link rel="stylesheet" href="{{ url('admin/css/common.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="{{ url('admin/css/style.css') }}">

	{{-- favicon --}}
    <link rel="icon" href="{{ url('images/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ url('images/apple-touch-icon.png') }}">
</head>

<body id="login_body">
<div id="login_container">

    <header>
        <h1>管理画面</h1>
        <p>- Light Plan Admin -</p>
    </header>

    <main>
        {{ Form::open() }}



            {{-- バリデーション エラーメッセージ --}}
            @if ($errors->any())
            <ul class="err_box">
                @foreach ($errors->all() as $error)
                    <li class="form_err_msg">{{ $error }}</li>
                @endforeach
            </ul>
            @endif

            <div class="box_form">
                <label class="form_label" for="email">メールアドレス</label>
                {{ Form::email
                    ('email', null,
                        [
                        'id'=>'email',
                        'class'=>'form_control',
                        ]
                    )
                }}
            </div>
            <div class="box_form">
                <label class="form_label" for="password">パスワード</label>
                {{ Form::password
                    ('password',
                        [
                        'id'=>'password', 'class'=>'form_control'
                        ]
                    )
                }}
            </div>

            <div class="box_form">
                <label class="check_pass" for="check_pass">
                    {{ Form::checkbox
                        ('display', null, false,
                            [
                            'id'=>'check_pass', 'class'=>'form_control',
                            ]
                        )
                    }}パスワードを表示する
                </label>
            </div>

            <div class="box_form">
                {{ Form::button
                    ('ログイン',
                        [
                        'type'=>'submit',
                        ]
                    )
                }}
            </div>


        {{ Form::close() }}
    </main>
</div>



{{-- script --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ url('admin/js/common.js') }}"></script>
<!-- パスワードの表示/非表示の切り替え -->
<script>
const pwd = document.getElementById('password');
const pwdCheck = document.getElementById('check_pass');
pwdCheck.addEventListener('change', function() {
    if(pwdCheck.checked) {
        pwd.setAttribute('type', 'text');
    } else {
        pwd.setAttribute('type', 'password');
    }
}, false);
</script>



</body>
</html>
