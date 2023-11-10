@extends('admin.common.layout2')

@section('title', 'ページ情報の編集')

@section('contents')
<main>
    <ol class="breadcrumb">
        <li>{{ link_to_route('wb-admin.dashboard', 'トップ') }}</li>
        <li>{{ link_to_route('wb-admin.page.index', 'ページ情報') }}</li>
        <li><a href="">編集</a></li>
    </ol>
    <section id="post_edit">
        <h2 class="hidden">投稿の編集</h2>
        <div class="wrapper">
            <div class="innerwrap">
                @include('admin.common.validation_error')
                {{ Form::open(['route'=>'wb-admin.page.postEdit']) }}
                @foreach ($pages as $page)
                    <h3>{{ $config_pages[$page['name']] }}</h3>
                    {{ Form::hidden($page['name'] . '[name]', $page['name'] ?? '') }}
                        @if($page['name'] !== 'index')
                            <label class="input_post_edit"><input type="checkbox" id={{ $page['name'] }} class="reflect">{{ $config_pages['index'] }}の情報を反映する</label>
                        @endif
                    <ul class="form_wrapper max600">
                        <li>
                            <label for="title" class="ttl_min ic_optional">タイトル</label>
                            <div class="input_wrapper">
                                {{ Form::text($page['name'] . '[title]', $page['title'] ?? '', ['id' =>'pageinfo_' . $page['name'] . '_title']) }}
                            </div>
                            <div class="cl"></div>
                        </li>
                        <li>
                            <label for="h1" class="ttl_min ic_optional">見出し</label>
                            <div class="input_wrapper">
                                {{ Form::text($page['name'] . '[h1]', $page['h1'] ?? '', ['id' => 'pageinfo_' . $page['name'] . '_h1']) }}
                            </div>
                            <div class="cl"></div>
                        </li>
                        <li>
                            <label for="description" class="ttl_min ic_optional">説明文</label>
                            <div class="input_wrapper">
                                {{ Form::text($page['name'] . '[description]', $page['description'] ?? '', ['id' => 'pageinfo_' . $page['name'] . '_description']) }}
                            </div>
                            <div class="cl"></div>
                        </li>
                        <li>
                            <label for="keywords" class="ttl_min ic_optional">キーワード</label>
                            <div class="input_wrapper">
                                {{ Form::text($page['name'] . '[keywords]', $page['keywords'] ?? '', ['id' => 'pageinfo_' . $page['name'] . '_keywords']) }}
                            </div>
                            <div class="cl"></div>
                        </li>
                    </ul>
                @endforeach
                <div class="fix_bt">
                    {{ Form::button('変更を保存する', ['type'=>'submit', 'class'=>'bt_center']) }}
                </div>
                {{ Form::close() }}
            </div>
            {{-- indexページのSEOタグ --}}
            @if ($index !== null)
                {{ Form::hidden('title', $index['title'] ?? '', ['id' => 'pageinfo_index_title']) }}
                {{ Form::hidden('description', $index['description'] ?? '', ['id' => 'pageinfo_index_description']) }}
                {{ Form::hidden('h1', $index['h1'] ?? '', ['id' => 'pageinfo_index_h1']) }}
                {{ Form::hidden('keywords', $index['keywords'] ?? '', ['id' =>'pageinfo_index_keywords']) }}
            @endif
        </div>
    </section>
</main>
<script>
// クラス名の(.)を(_)に置き換え
window.onload = function() {
    let target_elements = document.querySelectorAll('.reflect, input[type="text"]');
    for (let i = 0; i < target_elements.length; i++) {
        let target_id = target_elements[i].id;
        let new_id = target_id.replace('.', '_');
        target_elements[i].id = new_id;
    }
}
</script>
@endsection
