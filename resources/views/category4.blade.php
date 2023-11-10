@extends('common.layout')

@section('main')
<!-- ここからmain ********************************************************************************-->
<main class="index_4">

    <div class="subvisual">
      <h2>タイトルが入ります。</h2>
    </div>

    <div class="inner">
    <!-- ここからページによって異なるコンテンツ部分 -->
      <section class="sec spacing">

        <section class="sec_item">

          <div>
            <div class="secondary_title">
              <h3>h:3見出しが入ります</h3>
            </div>

            <p>
              <img src="{{ url('images/img_sec_04.jpg') }}" alt="タイトルが入ります。タイトルが入ります。" width="100%" loading="lazy">
            </p>
          </div>

          <div>
            <div class="tertiary_title">
              <h4>H:4見出しが入ります。見出しが入ります。見出しが入ります。</h4>
            </div>

            <p class="text">
              この文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーです。この文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーですこの文章はダミーです。
            </p>
          </div>

        </section>

      </section>

      <section class="sec">

        <div class="secondary_title spacing">
          <h3>h:3見出しが入ります</h3>
        </div>

        <section class="sec_item bg_color">
          <table class="table_02">
            <tr>
              <th>社名</th>
              <td>{{ $company->name }}</td>
            </tr>
            <tr>
              <th>所在地</th>
              <td>{{ $company->address }}</td>
            </tr>
            <tr>
              <th>設立</th>
              <td>{{ $company->established }}</td>
            </tr>
            <tr>
              <th>従業員数</th>
              <td>{{ $company->employees }}</td>
            </tr>
            <tr>
              <th>代表</th>
              <td>{{ $company->president }}</td>
            </tr>
            <tr>
              <th>業種</th>
              <td>{{ $company->business }}</td>
            </tr>
            <tr>
              <th>主な取扱</th>
              <td>{{ $company->client }}</td>
            </tr>
          </table>
        </section>

      </section>

      <section class="sec spacing">

        <div class="secondary_title">
          <h3>h:3見出しが入ります</h3>
        </div>

        <div class="map">
          <div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3241.7479754683745!2d139.7432442152582!3d35.65858048019946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188bbd9009ec09%3A0x481a93f0d2a409dd!2z5p2x5Lqs44K_44Ov44O8!5e0!3m2!1sja!2sjp!4v1643633789300!5m2!1sja!2sjp" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
          </div>

          <ul class="address">
            <li>{{ $company->address }}</li>
            <li>【最寄り駅】</li>
            <li>{{ $company->station_1 }}</li>
            <li>{{ $company->station_2 }}</li>
          </ul>
        </div>

      </section>
      <!-- //ここまでページによって異なるコンテンツ部分 -->
    </div>

  </main>
<!-- //ここまでmain ********************************************************************************-->

@endsection
