@extends('admin.common.layout')

@section('title', '投稿一覧')

@section('contents')
{{ Form::open() }}
<main class="main_top">
    <ol class="breadcrumb">
        <li>{{ link_to_route('wb-admin.dashboard', 'トップ') }}</li>
        <li>投稿一覧</li>
    </ol>
    <div class="bt_top">
        <div class="bt">
            <a class="bt_more add" href="{{ url('wb-admin/post/add') }}">
                <span class="material-icons">add_circle_outline</span>追加する
            </a>
            <button type="submit" class="bt_more delete" disabled>
                <span class="material-icons">delete</span>まとめて削除する
            </button>
        </div>
    </div>

    <section id="post_list">
        <h2 class="hidden">投稿一覧</h2>
        <div class="wrapper">
            <div class="innerwrap">
            @if ($posts->count() > 0)
                <ul class="list_card">
                    @foreach ($posts as $post)
                    <li>
                        <label for="post0{{ $post->id }}">
                            <input type="checkbox" name="del[]" id="post0{{ $post->id }}" class="check_delete" value="{{ $post->id }}" disabled>
                            <div class="list_box">
                                <div class="img_box">
                                    @if(isset($post->file_path))
                                    <img src="{{ Storage::disk('post')->url($post->file_path) }}" alt="{{ $post->title }}" loading="lazy">
                                    @else
                                    <img src="{{ Storage::disk('post')->url('noimage_post.jpg') }}" alt="{{ $post->title }}" loading="lazy">
                                    @endif
                                </div>
                                <div class="list_ttl">
                                    @if ($post->display == config('custom.display.on'))
                                    <label class="tgl_bt display"><span>{{ link_to_route('wb-admin.post.display', '表示中', $post->id.'?page='.request('page')) }}</span></label>
                                    @else
                                    <label class="tgl_bt hide"><span>{{ link_to_route('wb-admin.post.display', '非表示', $post->id.'?page='.request('page')) }}</span></label>
                                    @endif
                                    <b>{{ $post->title }}</b>
                                </div>
                                <div class="date font_annot_12">{{ $post->published_at }}</div>
                                <div class="font_annot_12">
                                    {!! removalImageTag($post->contents) !!}
                                </div>
                                <div class="bt">
                                    <a class="bt_edit" href="{{ url('wb-admin/post/edit/'.$post->id) }}">
                                        <span class="material-icons">edit</span>編集する
                                    </a>
                                </div>
                            </div>
                        </label>
                    </li>
                    @endforeach
                </ul>
                <div class="spacer_340"></div>
            @else
                <p class="ta_center text">投稿はまだありません</p>
            @endif
            </div>
        </div>
    </section>
    {{-- ページネーション --}}
    {{ $posts->links('vendor.pagination.default') }}
    <div class="fix_bt">
        <a class="bt_center add" href="{{ url('wb-admin/post/add') }}">
            <span class="material-icons">add_circle_outline</span>追加する
        </a>
        <button type="submit" class="bt_center delete" disabled>
            <span class="material-icons">delete</span>まとめて削除する
        </button>
        <input type="checkbox" id="choice" class="bt_choice">
        <label for="choice" class="choice">削除選択</label>
        <label for="choice" class="cancel">キャンセル</label>
    </div>
</main>
{{ Form::close() }}
@endsection
