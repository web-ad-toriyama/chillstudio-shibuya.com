@extends('common.layout')

@section('main')
<!-- ここからmain ********************************************************************************-->
<main class="index_11">

  <div class="subvisual">
    <h2>
      タイトルが入ります。
    </h2>
  </div>
  <div class="inner spacing">
    <!-- ここからページによって異なるコンテンツ部分 -->
    <section class="sec">

      {{-- 表示にないですが必要そうなので一応書いておく 必要な場合はコメントを外してください--}}
      {{-- {{ \Carbon\Carbon::parse($news->published_at)->format('Y.m.d') }} --}}
      {{-- {{ config('custom.icon.news')[$news->icon] }} --}}

      <div class="secondary_title">
        <h3>
          {{ $news->title }}
        </h3>
      </div>

      <p class="text">
        {!! nl2br(e($news->contents)) !!}
      </p>

      {{ link_to_route(config('custom.page.category6.route'), '一覧へ戻る', null, ['class'=>'btn_02']) }}

    </section>
    <!-- //ここまでページによって異なるコンテンツ部分 -->
  </div>

</main>
<!-- //ここまでmain ********************************************************************************-->
@endsection
