@extends('admin.common.layout')

@section('title', 'トップ')

@section('contents')
<main class="main_top">
    <div class="max975">

        {{-- 運営部からのお知らせ --}}
        <div class="information">
            <div class="box">
                <h2><span class="material-icons">info</span>運営部からのお知らせ</h2>
                    @if ($notices->count() > 1)
                    <ul class="acodion">
                        @foreach ($notices as $notice)
                        <li class="ac_box">
                            <div class="ac_toggle">
                                <time>{{ \Carbon\Carbon::parse($notice->published_at)->format('Y.m.d') }}</time>
								<p class="font_14">
                                    <span class="news_op ic_{{ $notice->icon }}">{{ config('custom.icon.notice')[$notice->icon] }}</span>
                                    @if($new_date <= $notice->published_at)
                                        <span class="new">NEW</span>
                                    @endif
                                    {{ $notice->title }}
                                </p>
							</div>
                            <div class="ac_content">
								<p class="font_12 ta_justify">{!! nl2br(e($notice->contents)) !!}</p>
							</div>
                        </li>
                        @endforeach
                    </ul>
                    @else
                        <p class="ta_center text">お知らせはまだありません</p>
                    @endif
            </div>
        </div>
        {{-- // 運営部からのお知らせ --}}


        <div class="shortcut">
            <a class="bt_short" href="{{ url('wb-admin/post/add') }}">
                <span class="material-icons">edit_note</span>投稿する
            </a>
            <a class="bt_short" href="{{ url('wb-admin/news/add') }}">
                <span class="material-icons">notifications</span>お知らせする
            </a>
            <a class="bt_short" href="{{ url('wb-admin/log') }}">
                <span class="material-icons">contact_page</span>お問い合わせ確認
            </a>
        </div>
        <div class="menu_other">
            {{ link_to_route('wb-admin.post.index', '投稿一覧', null, ['class'=>'menu_list']) }}
            {{ link_to_route('wb-admin.news.index', 'お知らせ一覧', null, ['class'=>'menu_list']) }}
            {{ link_to_route('wb-admin.notice.index', '運営部からのお知らせ', null, ['class'=>'menu_list']) }}
        </div>
    </div>
</main>

@endsection
