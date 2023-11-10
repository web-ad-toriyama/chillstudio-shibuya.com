@extends('common.layout')

@section('main')
<!-- ここからmain ********************************************************************************-->
<main class="index_2">
    <div class="subvisual"></div>

    <div class="inner spacing">
      <!-- ここからページによって異なるコンテンツ部分 -->
      <section class="sec">
        <section class="sec_item">
            <div>
              <div class="secondary_title">
                <h3>
                404 not found
                </h3>
              </div>
              <p class="text">
                お探しのページは一時的にアクセスができない状況にあるか、削除された可能性があります。<br />
              </p>
            </div>
        </section>
        <div class="btn_area">
            {{ link_to_route(config('custom.page.index.route'), 'サイトトップへ') }}
        </div>
    </section>
    <!-- //ここまでページによって異なるコンテンツ部分 -->
  </div>
</main>
<!-- //ここまでmain ********************************************************************************-->

@endsection
