@extends('common.layout')

@section('main')
<!-- ここからmain ********************************************************************************-->
<main>
    <div class="mainvisual swiper-container">
      <ul class="swiper-wrapper">
        <li class="swiper-slide">
          <picture>
            <source media="(min-width: 600px)" srcset="{{ url('images/mv_01_pc.jpg') }}">
            <img src="{{ url('images/mv_01_sp.jpg') }}">
          </picture>
        </li>
        <li class="swiper-slide">
          <picture>
            <source media="(min-width: 600px)" srcset="{{ url('images/mv_01_pc.jpg') }}">
            <img src="{{ url('images/mv_01_sp.jpg') }}">
          </picture>
        </li>
      </ul>
      <div class="swiper-pagination"></div>
    </div>
    <section class="cat cat_01" id="cat_01">
      <div class="inner">
        <h2 class="title"><span>ABOUT&nbsp;US</span>カテゴリ1</h2>
        <p class="text">
          この文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーです。
        </p>
        {{ link_to_route(config('custom.page.category1.route'), 'More', null, ['class'=>'btn_01']) }}
        {{-- <a href="" class="btn_01">More</a> --}}
      </div>
    </section>
    <section class="cat cat_02" id="cat_02">
      <div class="inner">
        <h2 class="title"><span>SERVICE</span>カテゴリ2</h2>
        <p class="text">
          この文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーです。
        </p>
        <div>
          <section>
            <p>
              <img src="{{ url('images/img_cat02_01.jpg') }}" alt="事業内容A" loading="lazy">
            </p>
            <h3>事業内容A</h3>
            <p class="text">この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。</p>
          </section>
          <section>
            <p>
              <img src="{{ url('images/img_cat02_02.jpg') }}" alt="事業内容B" loading="lazy">
            </p>
            <h3>事業内容B</h3>
            <p class="text">この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。</p>
          </section>
          <section>
            <p>
              <img src="{{ url('images/img_cat02_03.jpg') }}" alt="事業内容C" loading="lazy">
            </p>
            <h3>事業内容C</h3>
            <p class="text">この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。</p>
          </section>
        </div>
        {{ link_to_route(config('custom.page.category2.route'), 'More', null, ['class'=>'btn_01']) }}
        {{-- <a href="" class="btn_01">More</a> --}}
      </div>
    </section>

    <section class="cat cat_03" id="cat_03">
      <div class="inner">
        <h2 class="title"><span>WORKS</span>カテゴリ3</h2>
        @if ($posts->count() > 0)
        <div class="box">
          @foreach ($posts as $post)
          <article>
            <a href="{{ url(config('custom.page.category3_detail.url').'/'.$post->id) }}">
              <p>
                @if(isset($post->file_path))
                <img src="{{ Storage::disk('post')->url($post->file_path) }}" alt="{{ $post->title }}" loading="lazy" alt="blog_img">
                @else
                <img src="{{ Storage::disk('post')->url('noimage_post.jpg') }}" alt="{{ $post->title }}" loading="lazy" alt="noimage">
                @endif
              </p>
              <h3>{{ $post->title }}</h3>
              <time>{{ \Carbon\Carbon::parse($post->published_at)->format('Y.m.d H:i') }}</time>
              <div class="text">{!! removalImageTag($post->contents) !!}</div>
              <div class="stickarrow"></div>
            </a>
          </article>
          @endforeach
        </div>
        {{ link_to_route(config('custom.page.category3.route'), 'More', null, ['class'=>'btn_01']) }}
        {{-- <a href="index_3.html" class="btn_01">More</a> --}}
        @endif
        <a href="{{ url(config('custom.page.category7.url')) }}">
        <picture>
          <source media="(min-width: 600px)" srcset="{{ url('images/bnr_pc.jpg') }}">
          <img src="{{ url('images/bnr_sp.jpg') }}">
        </picture>
        </a>
      </div>
    </section>

    <section class="cat cat_04" id="cat_04">
      <div class="inner">
        <h2 class="title"><span>WORKS</span>見出し</h2>
        <div class="box">
          <div class="info">
            <ul>
              <li><span>所在地</span>〒{{ $company->zip_code }}<br>{{ $company->address }}</li>
              <li><span>電話番号</span><a href="tel:{{ $company->tel }}">{{ $company->tel }}</a></li>
              <li><span>営業時間</span>{{ $company->biz_hours }}</li>
              <li><span>定休日</span>{{ $company->closed }}</li>
            </ul>
            <div class="sns">
              <a href="" class="icon"><i class="fab fa-twitter"></i></a>
              <a href="" class="icon"><i class="fab fa-twitter"></i></a>
              <a href="" class="icon"><i class="fab fa-twitter"></i></a>
            </div>
          </div>
          <div class="btn">
            <a href="{{ config('custom.page.category4.url') }}" class="btn_02"><i class="fa-solid fa-house"></i>&nbsp;<br><i class="fas fa-angle-double-right"></i>&nbsp;{{ config('custom.page.category4.name') }}</a>
            <a href="{{ config('custom.page.category5.url') }}" class="btn_02"><i class="fa-solid fa-user"></i>&nbsp;<br><i class="fas fa-angle-double-right"></i>&nbsp;{{ config('custom.page.category5.name') }}</a>
          </div>
        </div>
      </div>
    </section>
    <section class="cat cat_05" id="cat_05">
      <div class="inner">
      <section>
          <h2 class="title"><span>NEWS</span>お知らせ</h2>
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
          {{ link_to_route(config('custom.page.category6.route'), 'More', null, ['class'=>'btn_01']) }}
          {{-- <a href="index_10.html" class="btn_01">More</a> --}}
          @endif
      </section>
      <section>
        <h2 class="title"><span>TWITTER</span>公式アカウント</h2>
        <div class="twitter_box">
          <a class="twitter-timeline" data-width="800" data-height="415" href="https://twitter.com/TwitterJP?ref_src=twsrc%5Etfw">Tweets by TwitterJP</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
    </section>
    </div>
    </section>
  </main>
<!-- //ここまでmain ********************************************************************************-->
@endsection
