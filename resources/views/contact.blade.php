@extends('common.layout')

@section('main')
<!-- ここからmain ********************************************************************************-->
<main class="index_9">

    <div class="subvisual">
      <h2>
        タイトルが入ります。
      </h2>
    </div>
    <div class="inner spacing">
    <!-- ここからページによって異なるコンテンツ部分 -->
      <section class="sec">
     
        <div class="secondary_title">
          <h3>
            h:3見出しが入ります
          </h3>
        </div>
        <!-- エラーメッセージ -->
        <ul class="error">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <li>※{{ $error }}</li>
                @endforeach
            @endif
        </ul>

        {{-- お問い合わせフォーム --}}
        {{ Form::open(['route'=>config('custom.page.contact_confirm.route')]) }}

        @foreach ($items as $index => $item)
            {{-- デフォルトのお問い合わせ項目 --}}
            {{-- お名前 --}}
            @if ($item->name === 'contact_name')
                <div class="item">
                    <label class="label" for="name">{{ $item->title }} <span class="required_red">※<span></label>
                    <div>
                        {{ Form::text('contact_name', null, ['class'=>'inputs']) }}
                    </div>
                </div>
            @endif

            {{-- メールアドレス --}}
            @if ($item->name === 'contact_email')
                <div class="item">
                    <label class="label" for="email">{{ $item->title }} <span class="required_red">※<span></label>
                    <div>
                        {{ Form::email('contact_email', null, ['class'=>'inputs']) }}
                    </div>
                </div>
            @endif

            {{-- メールアドレス確認用 --}}
            @if ($item->name === 'contact_email_confirmation')
                <div class="item">
                    <label class="label" for="email">{{ $item->title }} <span class="required_red">※<span></label>
                    <div>
                        {{ Form::email('contact_email_confirmation', null, ['class'=>'inputs']) }}
                    </div>
                </div>
            @endif

            {{-- 電話番号 --}}
            @if ($item->name === 'contact_tel')
                <div class="item">
                    <label class="label" for="tel">
                        {{ $item->title }}
                        @if ($item->required == 'required') <span class="required_red">※<span> @endif
                    </label>
                    <div>
                        {{ Form::tel('contact_tel', null, ['class'=>'inputs']) }}
                    </div>
                </div>
            @endif

            {{-- 郵便番号 --}}
            @if ($item->name === 'contact_post_code')
                <div class="item">
                    <label class="label" for="post_code">
                        {{ $item->title }}
                        @if ($item->required == 'required') <span class="required_red">※<span> @endif
                    </label>
                    <div class="post_code_box">
                        {{ Form::text('contact_post_code', null, ['class'=>'inputs', 'id'=>'post_code']) }}
                        @if ($items->contains('name', 'contact_address'))
                            <button class="btn_04" type="button" onclick="addressSearch()">住所を検索</button>
                        @endif
                    </div>
                </div>
            @endif

            {{-- 住所 --}}
            @if ($item->name === 'contact_address')
                <div class="item">
                    <label class="label" for="address">
                        {{ $item->title }}
                        @if ($item->required == 'required') <span class="required_red">※<span> @endif
                    </label>
                    <div>
                        {{ Form::text('contact_address', null, ['class'=>'inputs', 'id'=>'address']) }}
                    </div>
                </div>
            @endif

            {{-- お問い合わせ用件 --}}
            @if ($item->name === 'contact_requirement')
                <div class="item radiobtn">
                    <label class="label" for="requirement">
                        {{ $item->title }}
                        @if ($item->required == 'required') <span class="required_red">※<span> @endif
                    </label>
                    <div class="inputs">
                        @foreach (config('custom.icon.requirement') as $key => $value)
                        <div class="contact_item">
                            {{ Form::radio('contact_requirement', $key, null, ['id'=>'requirement_' . $key]) }}
                            <label for="requirement_{{ $key }}">{{ $value }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- お問い合わせ内容 --}}
            @if ($item->name === 'contact_contents')
                <div class="item comment">
                    <label class="label" for="contents">
                        {{ $item->title }}
                        @if ($item->required == 'required') <span class="required_red">※<span> @endif
                    </label>
                    <div>
                        {{ Form::textarea('contact_contents', null, ['id' => 'contents', 'class'=>'inputs', 'rows'=>8]) }}
                    </div>
                </div>
            @endif
            {{-- // ここまでデフォルトのお問い合わせ項目 --}}

            {{-- 管理画面で追加したお問い合わせ項目 --}}
            @if ($item->edit_mode === config('custom.contact.edit_mode.custom'))

                {{-- 入力形式：テキスト --}}
                @if ($item->format === 'text')
                    <div class="item txt">
                        <label class="label" for="custom_item{{ $item->id }}">
                            {{ $item->title }}
                            @if ($item->required == 'required') <span class="required_red">※<span> @endif
                        </label>
                        <div>
                            {{ Form::text($item->name, null, ['id' => 'custom_item' . $item->id, 'class'=>'inputs']) }}
                        </div>
                    </div>

                {{-- 入力形式：テキストボックス --}}
                @elseif ($item->format === 'textarea')
                    <div class="item comment">
                        <label class="label" for="custom_item{{ $item->id }}">
                            {{ $item->title }}
                            @if ($item->required == 'required') <span class="required_red">※<span> @endif
                        </label>
                        <div>
                        {{ Form::textarea($item->name, null, ['id' => 'custom_item' . $item->id, 'class'=>'inputs']) }}
                        </div>
                    </div>

                {{-- 入力形式：ラジオボタン --}}
                @elseif ($item->format === 'radio')
                    <div class="item radiobtn">
                        <label class="label" for="custom_item{{ $item->id }}">
                            {{ $item->title }}
                            @if ($item->required == 'required') <span class="required_red">※<span> @endif
                        </label>
                        <div class="inputs">
                        @foreach ($item->options as $key => $value)
                            <label for="custom_item{{ $item->id }}_option_{{ $key }}">
                            {{ Form::radio($item->name . '[]', $key, null, ['id' => 'custom_item' . $item->id . '_option_' . $key]) }}
                            {{ $value }}</label>
                        @endforeach
                        </div>
                    </div>

                {{-- 入力形式：プルダウン --}}
                @elseif ($item->format === 'select')
                    <div class="item pulldown">
                        <label class="label" for="custom_item{{ $item->id }}">
                            {{ $item->title }}
                            @if ($item->required == 'required') <span class="required_red">※<span> @endif
                        </label>
                        <div>
                        {{ Form::select($item->name . '[]', $item->options, null, ['id' => 'custom_item' . $item->id, 'class'=>'']) }}
                        </div>
                    </div>

                {{-- 入力形式：チェックボックス --}}
                @elseif ($item->format === 'checkbox')
                    <div class="item checkbox">
                        <label class="label" for="custom_item{{ $item->id }}">
                            {{ $item->title }}
                            @if ($item->required == 'required') <span class="required_red">※<span> @endif
                        </label>
                        <div class="inputs">
                        @foreach ($item->options as $key => $value)
                            <label for="custom_item{{ $item->id }}_option_{{ $key }}">{{ Form::checkbox($item->name . '[]', $key, null, ['id' => 'custom_item' . $item->id . '_option_' . $key]) }}
                                {{ $value }}</label>
                        @endforeach
                        </div>
                    </div>
                @endif
            @endif
            {{-- // ここまで 管理画面で追加したお問い合わせ項目 --}}
        @endforeach

          <div class="btn_area">
            <input type="submit" value="送信内容を確認する"><input type="reset" value="リセット">
          </div>

        {{ Form::close() }}
      </section>
    <!-- //ここまでページによって異なるコンテンツ部分 -->
    </div>


  </main>
<!-- //ここまでmain ********************************************************************************-->

@endsection
