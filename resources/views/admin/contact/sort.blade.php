@extends('admin.common.layout')

@section('title', 'お問い合わせ項目一覧 並び替え')

@section('contents')
{{ Form::open() }}
<main class="main_top">
    <ol class="breadcrumb">
        <li>{{ link_to_route('wb-admin.dashboard', 'トップ') }}</li>
        <li>{{ link_to_route('wb-admin.contact.index', 'お問い合わせ項目一覧') }}</li>
        <li>並び替え</li>
    </ol>
    <section id="post_list">
        <h2 class="hidden">投稿一覧</h2>
        <div class="wrapper">
            <div class="innerwrap">
            @if ($contacts->count() > 0)
                <ul id="items" class="list_card">
                    @foreach ($contacts as $contact)
                    <li>
                        <label for="post0{{ $contact->id }}">
                            <div class="list_box">
                                <div class="list_ttl">
                                    {{Form::input('hidden', 'id[]', $contact->id)}}
                                    @if ($contact->display == config('custom.display.on'))
                                        <label class="tgl_bt display"><span>表示中</span></label>
                                    @else
                                        <label class="tgl_bt hide"><span>非表示</span></label>
                                    @endif
                                    @if ($contact->edit_mode === config('custom.contact.edit_mode.custom'))
                                    {{ $contact->title }}
                                    @else
                                    {{ config('custom.contact.default.' . $contact->name) }}
                                    @endif
                                </div>
                            </div>
                        </label>
                    </li>
                    @endforeach
                </ul>
                <div class="spacer_340"></div>
            @else
                <p class="ta_center text">お問い合わせ項目はまだありません</p>
            @endif
            </div>
        </div>
    </section>
    <div class="fix_bt">
        <button type="submit" class="bt_center add">
            <span class="material-icons">sort</span>並び順を保存する
        </button>

    </div>
</main>
{{ Form::close() }}
@endsection
