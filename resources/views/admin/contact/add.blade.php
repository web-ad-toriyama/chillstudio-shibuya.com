@extends('admin.common.layout2')

@section('title', 'お問い合わせ項目の追加')

@section('contents')
<main>
    <ol class="breadcrumb">
        <li>{{ link_to_route('wb-admin.dashboard', 'トップ') }}</li>
        <li>{{ link_to_route('wb-admin.contact.index', 'お問い合わせ項目一覧') }}</li>
        <li><a href="">追加</a></li>
    </ol>
    <section id="post_edit">
        <h2 class="hidden">項目の追加</h2>
        <div class="wrapper">
            <div class="innerwrap">
                {{ Form::open(['id' => 'contact_item_form']) }}

                <div id="contact_form_0" class="mb_50">
                     <div class="form_inner">
                    <p class="item_title">追加項目1</p>
                    <ul class="form_wrapper max600">
                        <li>
                            <label for="contact_title" class="ttl_min ic_required">項目名</label>
                            <div class="input_wrapper">
                                {{ Form::text('title[]') }}
                            </div>
                            <div class="cl"></div>
                            <p class="contact_error error_title"></p>
                        </li>

                        <li>
                            <label for="required" class="ttl_min ic_required">入力</label>
                            <div class="input_wrapper">
                                @foreach (config('custom.contact.required') as $key => $value)
                                    {{ Form::radio('required[0]', $key, ($key == 1) ? true : false, ['class' => 'contact_required']) }}{{ $value }}
                                @endforeach
                            </div>
                            <div class="cl"></div>
                            <p class="contact_error error_required"></p>
                        </li>

                        <li>
                            <label for="format" class="ttl_min ic_required">入力形式</label>
                            <div class="input_wrapper">
                                {{ Form::select('format[0]', config('custom.contact.format'), null, ['class' => 'contact_format']) }}
                            </div>
                            <div class="cl"></div>
                            <p class="contact_error error_format"></p>
                        </li>


                        {{-- 以下、入力形式の選択時に動的に表示、非表示を切り替え --}}

                        {{-- 入力形式がテキスト・テキストエリアの場合 --}}
                        <li class="contact_select_option hidden">
                            <label for="select1" class="ttl_min ic_required">選択肢1</label>
                            <div class="input_wrapper">
                                {{ Form::text('select1[]') }}
                            </div>
                            <div class="cl"></div>
                            <p class="contact_error error_select1"></p>
                        </li>

                        <li class="contact_select_option hidden">
                            <label for="select2" class="ttl_min ic_required">選択肢2</label>
                            <div class="input_wrapper">
                                {{ Form::text('select2[]') }}
                            </div>
                            <div class="cl"></div>
                            <p class="contact_error  error_select2"></p>
                        </li>

                        <li class="contact_select_option hidden">
                            <label for="select3" class="ttl_min ic_optional">選択肢3</label>
                            <div class="input_wrapper">
                                {{ Form::text('select3[]') }}
                            </div>
                            <div class="cl"></div>
                        </li>

                        <li class="contact_select_option hidden">
                            <label for="select4" class="ttl_min ic_optional">選択肢4</label>
                            <div class="input_wrapper">
                                {{ Form::text('select4[]') }}
                            </div>
                            <div class="cl"></div>
                        </li>

                        <li class="contact_select_option hidden">
                            <label for="select5" class="ttl_min ic_optional">選択肢5</label>
                            <div class="input_wrapper">
                                {{ Form::text('select5[]') }}
                            </div>
                            <div class="cl"></div>
                        </li>

                        {{-- 入力形式がプルダウン・ラジオボタン・チェックボックスの場合 --}}
                        <li class="contact_text_option hidden">
                            <label for="option" class="ttl_min ic_optional">入力条件</label>
                            <div class="input_wrapper">
                                {{ Form::select('option[]', config('custom.contact.option'), null, ['class' => 'contact_option', 'placeholder' => '選択してください']) }}
                            </div>
                            <div class="cl"></div>
                        </li>

                        <li class="contact_text_option hidden">
                            <label for="max" class="ttl_min ic_optional">最大文字数</label>
                            <div class="input_wrapper">
                                {{ Form::text('max[]') }}
                            </div>
                            <div class="cl"></div>
                            <p class="contact_error error_max"></p>
                        </li>

                        <li class="contact_text_option hidden">
                            <label for="min" class="ttl_min ic_optional">最小文字数</label>
                            <div class="input_wrapper">
                                {{ Form::text('min[]') }}
                            </div>
                            <div class="cl"></div>
                            <p class="contact_error error_min"></p>
                        </li>
                    </ul>
                    </div>
                </div>

                <button id="add_contact_item" class="bt_center" type="button"><span class="material-icons">add_circle_outline</span>さらに項目を追加する</button>
                <div class="fix_bt">
                    {{ Form::button('項目を登録する', ['type'=>'submit', 'id'=>'contact_item_submit', 'class'=>'bt_center']) }}
                </div>

                {{ Form::close() }}
            </div>
        </div>
    </section>
</main>
@endsection
