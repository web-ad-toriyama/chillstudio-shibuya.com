@extends('common.layout')

@section('main')
<!-- ここからmain ********************************************************************************-->
<main class="index_10">

  <div class="subvisual">
    <h2>
      タイトルが入ります。
    </h2>
  </div>
  <div class="inner spacing">
    <!-- ここからページによって異なるコンテンツ部分 -->
    <section class="sec">
      @if ($news->count() > 0)
      <ul class="news_list">
        @foreach ($news as $value)
        <li>
          <a href="{{ url(config('custom.page.category6_detail.url').'/'.$value->id) }}">
            <article>
              <time>▶&nbsp;{{ \Carbon\Carbon::parse($value->published_at)->format('Y.m.d') }}</time>
              <h3>
                <span class="notice">{{ config('custom.icon.news')[$value->icon] }}</span><br>{{ $value->title }}
              </h3>
            </article>
          </a>
        </li>
        @endforeach
      </ul>
      @endif

      {{-- 🍆ページネーションの現在地の装飾をお願いします --}}
      {{ $news->links('vendor.pagination.official') }}

    </section>
    <!-- //ここまでページによって異なるコンテンツ部分 -->
  </div>

</main>
<!-- //ここまでmain ********************************************************************************-->
@endsection
