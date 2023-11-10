@extends('admin.common.layout')

@section('title', 'お問い合わせ項目一覧')

@section('contents')
{{ Form::open() }}
<main class="main_top">
    <div class="max975">
        <ol class="breadcrumb">
            <li>{{ link_to_route('wb-admin.dashboard', 'トップ') }}</li>
            <li><a href="">お問い合わせ項目一覧</a></li>
        </ol>
        <div class="bt_top">
            <div class="bt">
                <a class="bt_more add" href="{{ url('wb-admin/contact/add') }}">
                    <span class="material-icons">add_circle_outline</span>追加する
                </a>
                <a class="bt_more sort" href="{{ url('wb-admin/contact/sort') }}">
                    <span class="material-icons">sort</span>並び替える
                </a>
                <button type="submit" class="bt_more delete" disabled>
                    <span class="material-icons">delete</span>まとめて削除する
                </button>
            </div>
        </div>
        <section id="contact_list">
            <h2 class="hidden">お問い合わせ項目一覧</h2>
                <div class="wrapper">
                    <div class="innerwrap">

                        @if ($contacts)
                        <ul class="list_normal">
                            @foreach ($contacts as $contact)
                            <li>
                                <label for="contact0{{ $contact->id }}" class="flex">

                                    {{-- 削除可能項目の場合、「まとめて削除する」実行時のチェックボックスを設置 --}}
                                    @if ($contact->edit_mode === config('custom.contact.edit_mode.custom'))
                                        <input type="checkbox" name="del[]" id="contact0{{ $contact->id }}" class="check_delete" value="{{ $contact->id }}" disabled>
                                    @endif
                                    <div class="list_box">
                                        {{-- オフィシャルで、項目ごとのレイアウト変更が発生することを想定し、項目のidを出してます。不要な場合は消していただいて大丈夫です --}}
                                        <p class="font_annot_12">id : {{ $contact->id }}</p>

                                        <div class="list_ttl">
                                            {{-- 表示切り替えのボタンの出しわけ --}}
                                            @if ($contact->edit_mode === config('custom.contact.edit_mode.seq_only'))
                                                <label class="tgl_bt display"><span>固定</span></label>
                                            @elseif ($contact->display == config('custom.display.on'))
                                                <label class="tgl_bt display"><span>{{ link_to_route('wb-admin.contact.display', '表示中', $contact->id.'?page='.request('page')) }}</span></label>
                                            @else
                                                <label class="tgl_bt hide"><span>{{ link_to_route('wb-admin.contact.display', '非表示', $contact->id.'?page='.request('page')) }}</span></label>
                                            @endif

                                            {{-- 項目名を表示 --}}
                                            <b class="font_14">
                                                <span class="news_icon ic_1">{{ config('custom.contact.required')[$contact->required] }}</span><br>
                                                @if ($contact->edit_mode === config('custom.contact.edit_mode.custom'))
                                                {{ $contact->title }}
                                                @else
                                                {{ config('custom.contact.default.' . $contact->name) }}
                                                @endif
                                            </b>
                                        </div>

                                        {{-- 編集ボタンの出しわけ --}}
                                        <div class="bt">
                                            @if ($contact->edit_mode === config('custom.contact.edit_mode.seq_only'))
                                            <p class="bt_edit unabled">編集不可</p>
                                            @elseif ($contact->edit_mode === config('custom.contact.edit_mode.seq_display'))
                                            <p class="bt_edit unabled">
                                            表示変更のみ可
                                            @else
                                            <a class="bt_edit" href="{{ url('wb-admin/contact/edit/'.$contact->id) }}">
                                                <span class="material-icons">edit</span>編集する
                                            </a>
                                            @endif
                                        </div>

                                    </div>
                                </label>
                            </li>
                            @endforeach
                        </ul>
                        @else
                            <p class="ta_center text">お問い合わせ項目の登録はありません</p>
                        @endif
                    </div>
                </div>
        </section>
		<div class="fix_bt">
            <a class="bt_center add" href="{{ url('wb-admin/contact/add') }}">
				<span class="material-icons">add_circle_outline</span>追加する
			</a>
			<button type="submit" class="bt_center delete" disabled>
				<span class="material-icons">delete</span>まとめて削除する
			</button>
			<input type="checkbox" id="choice" class="bt_choice">
			<label for="choice" class="choice">削除選択</label>
			<label for="choice" class="cancel">キャンセル</label>
		</div>
    </div>
</main>
{{ Form::close() }}
@endsection
