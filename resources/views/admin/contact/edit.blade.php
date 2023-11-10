@extends('admin.common.layout2')

@section('title', 'お問い合わせ項目の編集')

@section('contents')
<main>
    <ol class="breadcrumb">
        <li>{{ link_to_route('wb-admin.dashboard', 'トップ') }}</li>
        <li>{{ link_to_route('wb-admin.contact.index', 'お問い合わせ項目一覧') }}</li>
        <li><a href="">編集</a></li>
    </ol>
    <section id="post_edit">
        <h2 class="hidden">項目の編集</h2>
        <div class="wrapper">
            <div class="innerwrap">
                @include('admin.common.validation_error')
                {{ Form::open(['id' => 'contact_item_form', 'id' => 'contact_item_form']) }}
                <ul class="form_wrapper max600">
                    <li>
                        <label for="title" class="ttl_min ic_required">項目名</label>
                        <div class="input_wrapper">
                            @if ($contact->edit_mode === config('custom.contact.edit_mode.custom'))
                                {{ Form::text('title', $contact->title) }}
                            @else
                                <p>{{ config('custom.contact.default.' . $contact->name) }}</p>
                            @endif
                        </div>
                        <div class="cl"></div>
                        <p class="contact_error error_title"></p>
                    </li>

                    <li>
                        <label for="required" class="ttl_min ic_required">入力</label>
                        <div class="input_wrapper">
                            @foreach (config('custom.contact.required') as $key => $value)
                                @if ($contact->required == $key)
                                {{ Form::radio('required', $key, true, ['class' => 'contact_required']) }}{{ $value }}
                                @else
                                {{ Form::radio('required', $key, false, ['class' => 'contact_required']) }}{{ $value }}
                                @endif
                            @endforeach
                        </div>
                        <div class="cl"></div>
                        <p class="contact_error error_input"></p>
                    </li>

                    <li>
                        <label for="format" class="ttl_min ic_required">入力形式</label>
                        <div class="input_wrapper">
                            @if ($contact->edit_mode === config('custom.contact.edit_mode.custom'))
                                {{ Form::select('format', config('custom.contact.format'), $contact->format, ['class' => 'contact_format']) }}
                            @else
                                <p>※ {{ config('custom.contact.default.' . $contact->name) }}の入力形式は変更できません</p>
                            @endif
                        </div>
                        <div class="cl"></div>
                        <p class="contact_error error_format"></p>
                    </li>

                    {{-- 以下、入力形式の選択時に動的に表示、非表示を切り替え --}}

                    {{-- 入力形式がテキスト・テキストエリアの場合 --}}
                    <li class="contact_select_option hidden">
                        <label for="select1" class="ttl_min ic_required">選択肢1</label>
                        <div class="input_wrapper">
                            {{ Form::text('select1', $contact->select1 ?? '') }}
                        </div>
                        <div class="cl"></div>
                        <p class="contact_error error_select1"></p>
                    </li>

                    <li class="contact_select_option hidden">
                        <label for="selectd2" class="ttl_min ic_required">選択肢2</label>
                        <div class="input_wrapper">
                            {{ Form::text('select2', $contact->select2 ?? '') }}
                        </div>
                        <div class="cl"></div>
                        <p class="contact_error  error_select2"></p>
                    </li>

                    <li class="contact_select_option hidden">
                        <label for="select3" class="ttl_min ic_optional">選択肢3</label>
                        <div class="input_wrapper">
                            {{ Form::text('select3', $contact->select3 ?? '') }}
                        </div>
                        <div class="cl"></div>
                    </li>

                    <li class="contact_select_option hidden">
                        <label for="select4" class="ttl_min ic_optional">選択肢4</label>
                        <div class="input_wrapper">
                            {{ Form::text('select4', $contact->select4 ?? '') }}
                        </div>
                        <div class="cl"></div>
                    </li>

                    <li class="contact_select_option hidden">
                        <label for="select5" class="ttl_min ic_optional">選択肢5</label>
                        <div class="input_wrapper">
                            {{ Form::text('select5', $contact->select5 ?? '') }}
                        </div>
                        <div class="cl"></div>
                    </li>

                    {{-- 入力形式がプルダウン・ラジオボタン・チェックボックスの場合 --}}
                    <li class="contact_text_option hidden">
                        <label for="option" class="ttl_min ic_optional">入力条件</label>
                        <div class="input_wrapper">
                            {{ Form::select('option', config('custom.contact.option'), $contact->option ?? '', ['class' => 'contact_option', 'placeholder' => '選択してください']) }}
                        </div>
                        <div class="cl"></div>
                    </li>

                    <li class="contact_text_option hidden">
                        <label for="max" class="ttl_min ic_optional">最大文字数</label>
                        <div class="input_wrapper">
                            {{ Form::text('max', $contact->max ?? '') }}
                        </div>
                        <div class="cl"></div>
                        <p class="contact_error error_max"></p>
                    </li>

                    <li class="contact_text_option hidden">
                        <label for="min" class="ttl_min ic_optional">最小文字数</label>
                        <div class="input_wrapper">
                            {{ Form::text('min', $contact->min ?? '') }}
                        </div>
                        <div class="cl"></div>
                        <p class="contact_error error_min"></p>
                    </li>

                {{ Form::hidden('edit_mode', $contact->edit_mode) }}
                <div class="fix_bt">
                    {{ Form::button('変更を保存する', ['type'=>'submit', 'id'=>'contact_item_submit', 'class'=>'bt_center']) }}
                </div>
                </ul>
                {{ Form::close() }}
            </div>
        </div>
    </section>
</main>
<script>
    contact = {!! json_encode($contact) !!};
</script>
@endsection
