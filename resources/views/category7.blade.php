@extends('common.layout')

@section('main')
<!-- ここからmain ********************************************************************************-->
<main class="index_5">

    <div class="subvisual">
      <h2>タイトルが入ります。</h2>
    </div>

    <div class="inner spacing">
    <!-- ここからページによって異なるコンテンツ部分 -->

      <section class="sec">

        <div class="secondary_title">
          <h3>h:3見出しが入ります</h3>
        </div>

        <section class="sec_item">
          <p>
            <img src="{{ url('/images/img_sec_04.jpg') }}" alt="タイトルが入ります。タイトルが入ります。" width="100%" loading="lazy">
          </p>

          <div class="group">
            <div class="product">
              <p>品名が入ります</p>
              <span></span>
              <p>0,000円</p>
            </div>

            <p class="text">
              この文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーです。この文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーです。
            </p>
          </div>
        </section>

        <section class="sec_item">
          <p>
            <img src="{{ url('/images/img_sec_04.jpg') }}" alt="タイトルが入ります。タイトルが入ります。" width="100%" loading="lazy">
          </p>

          <div class="group">
            <div class="product">
              <p>品名が入ります</p>
              <span></span>
              <p>0,000円</p>
            </div>

            <p class="text">
              この文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーです。この文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーです。
            </p>
          </div>
        </section>

      </section>

      <section class="sec">

        <div class="secondary_title">
          <h3>h:3見出しが入ります</h3>
        </div>

        <table class="table_01">
          <tr>
            <th>商品が入ります</th>
            <td>0,000円</td>
          </tr>
          <tr>
            <th>商品が入ります</th>
            <td>0,000円</td>
          </tr>
          <tr>
            <th>商品が入ります</th>
            <td>0,000円</td>
          </tr>
        </table>

        <h4>品名が入ります</h4>
        <table class="table_03">
          <tr>
            <th>品名</th>
            <th>品名</th>
            <th>品名</th>
            <th>品名</th>
          </tr>
          <tr>
            <th>品名が入ります</th>
            <td>0,000円</td>
            <td>0,000円</td>
            <td>0,000円</td>
          </tr>
          <tr>
            <th>品名が入ります</th>
            <td>0,000円</td>
            <td>0,000円</td>
            <td>0,000円</td>
        </tr>
      </table>

      </section>
      <!-- //ここまでページによって異なるコンテンツ部分 -->
    </div>

  </main>
<!-- //ここまでmain ********************************************************************************-->

@endsection
