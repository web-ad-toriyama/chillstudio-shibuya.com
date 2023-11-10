@extends('common.layout')

@section('main')
<!-- ここからmain ********************************************************************************-->
      <main class="index_7">

        <div class="subvisual">
          <h2>
            {{ $post->title }}
          </h2>
        </div>

        <div class="flex inner">
        <!-- ここからページによって異なるコンテンツ部分 -->
          <section class="sec">
            <div class="secondary_title spacing">
              <h3>
                h:3見出しが入ります
              </h3>
            </div>

            <section class="sec_item spacing">
              <p>
                @if(isset($post->file_path))
                <img src="{{ Storage::disk('post')->url($post->file_path) }}" alt="{{ $post->title }}"  width="100%" loading="lazy">
                @endif
              </p>
            </section>

            <div class="text bg_color">
            {!! $post->contents !!}
            </div>

            {{ link_to_route(config('custom.page.category3.route'), '一覧へ戻る', null, ['class'=>'btn_02']) }}
          </section>

          <section class="sec spacing">

            <h4>
              最新の投稿
            </h4>

            <div class="box">
              @foreach ($posts as $post)
              <section>
                <article>
                  <a href="{{ url(config('custom.page.category3_detail.url').'/'.$post->id) }}">
                  <p>
                    @if(isset($post->file_path))
                    <img src="{{ Storage::disk('post')->url($post->file_path) }}" alt="{{ $post->title }}" loading="lazy">
                    @else
                    <img src="{{ Storage::disk('post')->url('noimage_post.jpg') }}" alt="{{ $post->title }}" loading="lazy">
                    @endif
                  </p>
                  <h5>{{ $post->title }}</h5>
                  </a>
                </article>
              </section>
              @endforeach
            </div>

          </section>
        <!-- //ここまでページによって異なるコンテンツ部分 -->
        </div>

      </main>
<!-- //ここまでmain ********************************************************************************-->
@endsection
