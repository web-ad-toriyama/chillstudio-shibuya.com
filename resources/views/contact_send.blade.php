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

      @if (session('error_message'))
        <p>{{ session('error_message') }}</p>
      @else
        <p>送信が完了しました。</p>
      @endif

      <div class="btn_area">
        {{ link_to_route(config('custom.page.index.route'), 'サイトトップへ') }}
      </div>

    </section>
  <!-- //ここまでページによって異なるコンテンツ部分 -->
  </div>


</main>
<!-- //ここまでmain ********************************************************************************-->
@endsection
