@extends('admin.common.layout')

@section('title', 'お知らせ一覧')

@section('contents')
{{ Form::open() }}
<main class="main_top">
    <div class="max975">
        <ol class="breadcrumb">
            <li>{{ link_to_route('wb-admin.dashboard', 'トップ') }}</li>
            <li><a href="">お知らせ一覧</a></li>
        </ol>
        <div class="bt_top">
            <div class="bt">
                <a class="bt_more add" href="{{ url('wb-admin/news/add') }}">
                    <span class="material-icons">add_circle_outline</span>追加する
                </a>
                <button type="submit" class="bt_more delete" disabled>
                    <span class="material-icons">delete</span>まとめて削除する
                </button>
            </div>
        </div>
        <section id="news_list">
            <h2 class="hidden">お知らせ一覧</h2>
                <div class="wrapper">
                    <div class="innerwrap">
                        @if ($news->count() > 0)
                        <ul class="list_normal">
                            @foreach ($news as $value)
                            <li>
                                <label for="news0{{ $value->id }}" class="flex">
                                    <input type="checkbox" name="del[]" id="news0{{ $value->id }}" class="check_delete" value="{{ $value->id }}" disabled>
                                    <div class="list_box">
                                        <div class="list_ttl">
                                            @if ($value->display == config('custom.display.on'))
                                            <label class="tgl_bt display"><span>{{ link_to_route('wb-admin.news.display', '表示中', $value->id.'?page='.request('page')) }}</span></label>
                                            @else
                                            <label class="tgl_bt hide"><span>{{ link_to_route('wb-admin.news.display', '非表示', $value->id.'?page='.request('page')) }}</span></label>
                                            @endif
                                            <div class="date font_annot_12">{{ \Carbon\Carbon::parse($value->published_at)->format('Y.m.d') }}</div>
                                            <b class="font_14">
                                                <span class="news_icon ic_{{ $value->icon }}">{{ config('custom.icon.news')[$value->icon] }}</span><br>
                                                {{ $value->title }}
                                            </b>
                                        </div>
                                        <div class="bt">
                                            <a class="bt_edit" href="{{ url('wb-admin/news/edit/'.$value->id) }}">
                                                <span class="material-icons">edit</span>編集する
                                            </a>
                                        </div>
                                    </div>
                                </label>
                            </li>
                            @endforeach
                        </ul>
                        @else
                            <p class="ta_center text">お知らせはまだありません</p>
                        @endif
                    </div>
                </div>
        </section>
        {{-- ページネーション --}}
        {{ $news->links('vendor.pagination.default') }}
		<div class="fix_bt">
			<a class="bt_center add" href="add.html">
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
