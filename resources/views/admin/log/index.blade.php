@extends('admin.common.layout')

@section('title', 'お問い合わせ一覧')

@section('contents')
<main class="main_top">
    <div class="max975">
        <ol class="breadcrumb">
            <li>{{ link_to_route('wb-admin.dashboard', 'トップ') }}</li>
            <li><a>お問い合わせ一覧</a></li>
        </ol>
        <section id="contactlog">
            <h2 class="hidden">お問い合わせ一覧</h2>
            <div class="wrapper">
                <div class="innerwrap">
                    @if ($logs->count() > 0)
                    <p class="font_annot_12 caption">受信から{{ config('custom.log_life_month') }}ヶ月後に自動的に削除されます。</p>
                    <ul class="acodion">
                        <li class="lead">
                            <p class="font_14">日付</p>
                            <p class="font_14">お名前</p>
                        </li>
                        @foreach($logs as $log)
                        <li class="ac_box">
                            <div class="ac_toggle">
                                <div class="contact_date">{{ \Carbon\Carbon::parse($log->created_at)->format('Y.m.d') }}</div>
                                <b class="contact_name">{{ $log->name }}</b>
                            </div>
                            <ul class="ac_content">
                                <li>
                                    <span class="font_12">メールアドレス</span>
                                    <p class="email">{{ $log->email }}</p>
                                </li>
                                <li>
                                    <span class="font_12">お問い合わせ内容</span>
                                    <p class="contents">
                                        {!! nl2br(e($log->contents)) !!}
                                    </p>
                                </li>
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                    @else
                        <p class="ta_center text">お問い合わせはまだありません</p>
                    @endif
                </div>
            </div>
        </section>
        {{ $logs->links('vendor.pagination.default') }}
    </div>
</main>
@endsection
