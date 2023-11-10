@extends('admin.common.layout')

@section('title', 'ページ情報')

@section('contents')

<main id="pageinfo" class="main_top">
    <div class="max975">
        <ol class="breadcrumb">
            <li>{{ link_to_route('wb-admin.dashboard', 'トップ') }}</li>
            <li><a href="">ページ情報</a></li>
        </ol>
        <h2 class="hidden">ページ情報</h2>
        <div class="wrapper">
            <div class="innerwrap">
                <h3>ページ情報をまとめて編集</h3>
                <div class="input_wrapper">
                    @include('admin.common.validation_error')
                    {{ Form::open(['route'=>'wb-admin.page.postIndex']) }}
                    @foreach (config('custom.page') as $page)
                    {{-- custom.phpにルートの設定があり、かつページ情報の統一を行わないページの場合、チェックボックスを表示 --}}
                    @if (isset($page['route']) && array_search($page['route'], array_keys(config('custom.page_info')), false) === false)
                    <label class="input_pageinfo">
                        {{ Form::checkbox('route[]', $page['route'], false, ['class'=>'pageinfo_route check_items', 'onclick' => 'changeSelectBoxes()']) }}{{ $page['name'] }}
                    </label>
                    @endif
                    @endforeach
                    <label class="input_pageinfo">
                        {{ Form::checkbox('route[]', 'all', false, ['class'=>'pageinfo_route check_all', 'onclick' => 'changeSelectAll()']) }}全てのページ
                    </label>
                    {{ Form::button('まとめて編集する', ['type'=>'submit', 'class'=>'bt_edit pages disabled', 'disabled'=>'disabled']) }}
                    {{ Form::close() }}
                </div>
                @if ($pages->isNotEmpty())
                @foreach ($pages as $page)
                    <table class="table_01 text_box box_outer">
                        <caption>{{ $config_pages[$page['name']] }}</caption>
                        <tr>
                            <th>タイトル</th>
                            <td>{{ $page->title }}</td>
                        </tr>
                        <tr>
                            <th>見出し</th>
                            <td>{{ $page->h1 }}</td>
                        </tr>
                        <tr>
                            <th>説明文</th>
                            <td>{{ $page->description }}</td>
                        </tr>
                        <tr>
                            <th>キーワード</th>
                            <td>{{ $page->keywords }}</td>
                        </tr>
                    </table>
                    <div class="bt">
                        <a class="bt_edit" href="{{ url('wb-admin/page/edit/' . $page->id) }}">
                            <span class="material-icons">edit</span>編集する
                        </a>
                    </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</main>
@endsection
