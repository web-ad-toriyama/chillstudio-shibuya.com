@extends('admin.common.layout')

@section('title', '運営部からのお知らせ')

@section('contents')
<main class="main_top">
    <div class="max975">
        <ol class="breadcrumb">
            <li>{{ link_to_route('wb-admin.dashboard', 'トップ') }}</li>
            <li><a>運営部からのお知らせ</a></li>
        </ol>
        <section id="operation">
            <h2 class="hidden">運営部からのお知らせ一覧</h2>
            <div class="wrapper">
                <div class="innerwrap">
                    @if ($notices->count() > 0)
                    <ul class="acodion">
                        @foreach ($notices as $notice)
                        <li class="ac_box">
                            <div class="ac_toggle">
                                <span class="news_op ic_{{ $notice->icon }}">{{ config('custom.icon.notice')[$notice->icon] }}</span>
                                <div class="date font_annot_12">{{ \Carbon\Carbon::parse($notice->published_at)->format('Y.m.d') }}</div>
                                <p class="font_thum_14">@if($new_date <= $notice->published_at) <span class="new">NEW</span> @endif{{ $notice->title }}</p>
                            </div>
                            <div class="ac_content">
                                <p class="font_14">{!! nl2br(e($notice->contents)) !!}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @else
                        <p class="ta_center text">お知らせはまだありません</p>
                    @endif
                </div>
            </div>
        </section>
        {{ $notices->links('vendor.pagination.default') }}
    </div>
</main>
@endsection
