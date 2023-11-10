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

        {{-- 🍆フォームのスタイルの修正をお願いします --}}
        {{ Form::open(['route'=>config('custom.page.contact_send.route')]) }}

        @foreach ($items as $item)
            {{-- お問い合わせ項目ごとに表示欄を生成 --}}
            <div class="item">
                {{-- 項目名 --}}
                <label class="label" for="{{ $item->name }}">{{ $item->title }}</label>

                {{-- 入力内容 --}}
                <div>
                    @if (!is_array($request[$item->name]))
                        {{ $request[$item->name] }}
                        {{ Form::hidden($item->name, $request[$item->name], ['id' => $item->name]) }}

                    {{-- 入力形式が選択肢の場合は、選択された項目を全て表示 --}}
                    @else
                        @foreach ($request[$item->name] as $key => $value)
                            {{ Form::hidden($item->name . '[]', $item->$value, ['id' => 'custom_item' . $item->id . '_option_' . $key]) }}
                            <label for="custom_item{{ $item->id }}_option_{{ $key }}">
                                {{ $item->$value }}
                            </label>
                        @endforeach

                    @endif
                </div>
            </div>
        @endforeach
        {{-- お問い合わせ項目ごとに表示欄ここまで--}}

        <div class="btn_area">
          <input type="submit" value="送信する">
          {{-- 🍆確認画面なのでリセットすることはできません --}}
          <input type="reset" value="戻る" onclick="history.back();">
        </div>

      {{ Form::close() }}
    </section>
  <!-- //ここまでページによって異なるコンテンツ部分 -->
  </div>

</main>
<!-- //ここまでmain ********************************************************************************-->
@endsection
