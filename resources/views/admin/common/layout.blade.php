<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex,nofollow">
	<meta name="format-detection" content="telephone=no">
	<meta name='viewport' content="width=device-width, initial-scale=1, viewport-fit=cover">

	<title>@yield('title') | ホームページ管理システム</title>
	{{-- css --}}
	<link rel="stylesheet" href="{{ url('admin/css/destyle.css') }}">
	<link rel="stylesheet" href="{{ url('admin/css/common.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="{{ url('admin/css/style.css') }}">

	{{-- favicon --}}
    <link rel="icon" href="{{ url('images/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ url('images/apple-touch-icon.png') }}">
</head>


<body>
	<div class="fix_menu fullscreen_box">

		<header class="content_header">
			<div class="fullscreen_toggle">
				<div class="open_menu">
					<span></span><span></span><span></span>
				</div>
			</div>
			<div class="font_18 sp">{{ $company->name }}様</div>
			<div class="font_18 pc">@yield('title')</div>

			{{-- 処理失敗 メッセージ --}}
			@if (session('error_message'))
				<div class="bubbly_box bubbly_err">
					<div class="bubbly_button">
						<span class="bubbly_close">×</span>
						<span class="bubbly_text">{{ session('error_message') }}</span>
					</div>
				</div>
			@endif

			{{-- 処理成功 メッセージ --}}
			@if (session('success_message'))
				<div class="bubbly_box bubbly_success">
					<div class="bubbly_button">
						<span class="bubbly_close">×</span>
						<span class="bubbly_text">{{ session('success_message') }}</span>
					</div>
				</div>
			@endif

		</header>

		<!-- ナビゲーション -->
		<nav class="fullscreen_content">
			<h1>{{ $company->name }}様</h1>
			<ul class="nav_content acodion">
				<li class="ac_box">
					<a class="font_thum_14" href="{{ url('wb-admin') }}">
						トップ
					</a>
				</li>
				<li class="ac_box">
					<a class="font_thum_14" href="{{ url('wb-admin/notice') }}">
						運営部からのお知らせ
					</a>
				</li>
				<li class="ac_box">
					<a class="font_thum_14" href="{{ url('wb-admin/post') }}">
						投稿一覧
					</a>
				</li>
				<li class="ac_box">
					<a class="font_thum_14" href="{{ url('wb-admin/news') }}">
						お知らせ一覧
					</a>
				</li>
				<li class="ac_box">
					<a class="font_thum_14" href="{{ url('wb-admin/log') }}">
						お問い合わせ一覧
					</a>
				</li>
                <li class="ac_box">
                    <a class="font_thum_14" href="{{ url('wb-admin/contact') }}">
                        お問い合わせ項目設定
                    </a>
                </li>
                <li class="ac_box">
                    <a class="font_thum_14" href="{{ url('wb-admin/company') }}">
                        会社情報
                    </a>
                </li>
                <li class="ac_box">
                    <a class="font_thum_14" href="{{ url('wb-admin/page') }}">
                        ページ情報
                    </a>
                </li>
			</ul>
			<div class="bt_nav">
				<a href="{{ env('APP_URL') }}"><span class="material-icons">open_in_new</span>ホームページを確認する</a>
				<a href="{{ url('logout') }}"><span class="material-icons">logout</span>ログアウト</a>
				<a href="https://web-ad.co.jp"><small class="font_copy">&copy;&nbsp;2023&nbsp;Web@Ad Inc.</small></a>
			</div>

		</nav>
	</div>




    @yield('contents')


{{--
	<div class="footer_wrapper">
		<div id="page_top" class=""><a href="#"><i></i></a></div>
		<footer>
			<div class="innerwrap">
				<small class="font_11">COPYRIGHT&nbsp;&copy;&nbsp;2022&nbsp;<span class="sp_hidden">All Right Reserved.</span></small>
			</div>
		</footer>
	</div>
--}}
{{-- CKEditor --}}
<script src="//cdn.ckeditor.com/4.15.0/full/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ url('admin/js/ckeditor.js') }}"></script>
<script src="{{ url('admin/js/Sortable.min.js') }}"></script>
<script src="{{ url('admin/js/common.js') }}"></script>
</body>
</html>
