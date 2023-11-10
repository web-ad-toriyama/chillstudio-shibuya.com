@extends('common.layout')

@section('main')
<!-- ここからmain ********************************************************************************-->
<main class="index_8">

    <div class="subvisual">
      <h2>
        タイトルが入ります。
      </h2>
    </div>

    <div class="inner">
      <!-- ここからページによって異なるコンテンツ部分 -->
      <section class="sec">
        <div class="secondary_title spacing">
          <h3>
            h:3見出しが入ります
          </h3>
        </div>

        <section class="sec_item bg_color">
          <table class="table_02">
            <tr>
              <th>募集職種</th>
              <td>○○</td>
            </tr>
            <tr>
              <th>勤務地</th>
              <td>東京都■■区○町00-00</td>
            </tr>
            <tr>
              <th>募集条件</th>
              <td>000歳以上、高卒</td>
            </tr>
            <tr>
              <th>募集人数</th>
              <td>000名</td>
            </tr>
            <tr>
              <th>給与</th>
              <td>時給0,000円</td>
            </tr>
            <tr>
              <th>賞与</th>
              <td>□□□□□□</td>
            </tr>
            <tr>
              <th>待遇</th>
              <td>□□□、□□□、□□□など</td>
            </tr>
            <tr>
              <th>勤務時間</th>
              <td>00:00~00:00</td>
            </tr>
            <tr>
              <th>定休日</th>
              <td>完全週休2日制</td>
            </tr>
            <tr>
              <th>業務内容</th>
              <td>□□□、□□□、□□□など</td>
            </tr>
          </table>
        </section>
      </section>
      <!-- //ここまでページによって異なるコンテンツ部分 -->
    </div>

  </main>
<!-- //ここまでmain ********************************************************************************-->

@endsection
