@extends('common.layout')

@section('main')
    <!-- ここからmain ********************************************************************************-->
    <!-- お問い合わせ - contact -->

    <main id="page_contact">

        <div class="subvisual">
            <h2 class="title"><span title="お問い合わせ">CONTACT</span></h2>
        </div>

        <div class="inner spacing">
            <!-- ここからページによって異なるコンテンツ部分 -->
            <section class="contents">

                <div class="secondary_title"><h3>送信内容の確認</h3></div>

                {{-- 🍆フォームのスタイルの修正をお願いします --}}
                {{ Form::open(['route'=>config('custom.page.contact_send.route')]) }}

                <div class="tertiary_title"><h4>お客様情報</h4></div>
                <div class="item">
                    <label class="label" for="name">お名前&nbsp;<span class="required_red">※</span></label>
                    <div>
                        {{ $request['contact_name'] }}
                        {{ Form::hidden('contact_name', $request['contact_name']) }}
                    </div>
                </div>
                <div class="item">
                    <label class="label" for="name">予約希望日&nbsp;<span class="required_red">※</span></label>
                    <div>
                        @for($i=1; $i<=$request['day_count'];$i++)
                            {{ $request['contact_day'.$i] }}
                            {{ $request['contact_start'.$i] }}時から
                            {{ $request['contact_time'.$i] }}時間<br>
                            {{ Form::hidden('contact_day'.$i, $request['contact_day'.$i]) }}
                            {{ Form::hidden('contact_start'.$i, $request['contact_start'.$i]) }}
                            {{ Form::hidden('contact_time'.$i, $request['contact_time'.$i]) }}
                        @endfor
                        {{ Form::hidden('day_count', $request['day_count']) }}
                        {{ Form::hidden('contact_name', $request['contact_name']) }}
                    </div>
                </div>
                <div class="item">
                    <label class="label" for="name">メールアドレス&nbsp;<span class="required_red">※</span></label>
                    <div>
                        {{ $request['contact_email'] }}
                        {{ Form::hidden('contact_email', $request['contact_email']) }}
                    </div>
                </div>
                <div class="item">
                    <label class="label" for="name">電話番号&nbsp;<span class="required_red">※</span></label>
                    <div>
                        {{ $request['contact_tel'] }}
                        {{ Form::hidden('contact_tel', $request['contact_tel']) }}
                    </div>
                </div>
                <div class="item">
                    <label class="label" for="post_code">郵便番号</label>
                    <div>
                        {{ $request['post_code'] }}
                        {{ Form::hidden('post_code', $request['post_code']) }}

                    </div>
                </div>

                <div class="item">
                    <label class="label" for="address">ご住所</label>
                    <div>
                        {{ $request['contact_address'] }}
                        {{ Form::hidden('contact_address', $request['contact_address']) }}
                    </div>
                </div>


                <div id="form_confirm_inquiry">
                    <div class="tertiary_title"><h4>お問い合わせ内容</h4></div>
                    <div class="item">
                        <label class="label" for="address">お問い合わせ要件</label>
                        <div>
                            {{ config('custom.icon.requirement')[$request['contact_requirement']] }}
                            {{ Form::hidden('contact_requirement', config('custom.icon.requirement')[$request['contact_requirement']]) }}
                        </div>
                    </div>
                    <div class="item">
                        <label class="label" for="inquiry_contents">お問い合わせ内容</label>
                        <div>
                            {{ $request['contact_contents'] }}
                            {{ Form::hidden('contact_contents', $request['contact_contents']) }}
                        </div>
                    </div>
                </div>


                <div class="btn_area">
                    <input type="submit" value="送信する" class="link_act_01">
                    {{-- 🍆確認画面なのでリセットすることはできません --}}
                    <input type="reset" value="戻る" onclick="history.back();" class="link_act_01">
                </div>

                {{ Form::close() }}
            </section>
            <!-- //ここまでページによって異なるコンテンツ部分 -->
        </div>

    </main>
    <!-- //ここまでmain ********************************************************************************-->
@endsection
