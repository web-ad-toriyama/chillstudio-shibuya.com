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
	<header class="edit">
		<a class="back" href="javascript:history.back();"><span class="ic_back"></span></a>
		<h1 class="ttl font_18">@yield('title')</h1>
	</header>

    @yield('contents')

	<div class="spacer_340"></div>
{{-- CKEditor --}}
<script src="//cdn.ckeditor.com/4.15.0/full/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ url('admin/js/ckeditor.js') }}"></script>
<script src="{{ url('admin/js/common.js') }}"></script>

<script>
function loadImage(obj)
{
	var fileReader = new FileReader();
	var preview_img = document.getElementById('preview_img');

	fileReader.onload = (function (e) {
		if (document.getElementById('preview_img') != null) {
			preview_img.remove();
		}
		document.getElementById('preview_box').innerHTML += '<img id="preview_img" src="' + e.target.result + '">';
	});
	fileReader.readAsDataURL(obj.files[0]);
}
</script>

</body>
</html>
