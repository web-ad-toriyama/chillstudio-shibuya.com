@extends('common.layout')

@section('main')
    <!-- ここからmain ********************************************************************************-->
    <!-- お問い合わせ - contact -->

    <main id="page_contact">

    <div class="subvisual">
        <h2 class="ff_en fw_b">CONTACT</h2>
        <p>掲載希望者様フォーム</p>
    </div>

    <section class="form_contact section_pad60">
        <div class="inner700 width_p30">

            <div class="form_outer">
                {{-- エラーはここでまとめて出力しているのでエラー表示の装飾をお願いします --}}
                @if ($errors->any())
                    <ul class="error">
                        @foreach ($errors->all() as $error)
                            <li>※{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <div id="form_customer">
                {{ Form::open(['route'=>config('custom.page.contact_confirm.route')]) }}
                    <!-- お客様情報 -->
                    <div class="tertiary_title"><h4>お客様情報</h4></div>
                    <div class="item">
                        <label class="label" for="company">お名前 <span class="required_red">※<span></label>
                        <div>
                            {{ Form::text('contact_name', null, ['class'=>'inputs']) }}
                        </div>
                    </div>
                    <div class="item">
                        <label class="label" for="company">予約希望日 <span class="required_red">※<span></label>
                        <div>
                            <input type="hidden" name="day_count" value="1">
                            @for($i=1; $i<=5;$i++)
                                <br>
                                <div @if($i > 1)style="display:none"@endif class="date{{$i}}">
                                    日付{{ Form::date('contact_day'.$i, \Carbon\Carbon::now()->format('Y-m-d')) }}
                                    <select class="form-control" name="contact_start{{$i}}">
                                        @for($j=0; $j<=23;$j++)
                                        <option value="{{$j}}">{{$j}}</option>
                                        @endfor
                                    </select>時から
                                    <select class="form-control" name="contact_time{{$i}}">
                                        @for($k=1; $k<=5;$k++)
                                            <option value="{{$k}}">{{$k}}</option>
                                        @endfor
                                    </select>時間
                                </div>
                            @endfor
                            <span class="add">追加</span>
                            <span class="del" style="display:none">削除</span>

                            <script type="text/javascript">
                                $('.add').on('click', function() {
                                    var int = parseInt($('input[name="day_count"]').val()) + 1;
                                    $('input[name="day_count"]').val(int);
                                    $('.date'+int).show();
                                    $('.del').show();
                                    if(int == 5){
                                        $('.add').hide();
                                    }
                                });
                                $('.del').on('click', function() {
                                    var before = parseInt($('input[name="day_count"]').val());
                                    var int = parseInt($('input[name="day_count"]').val()) - 1;
                                    $('input[name="day_count"]').val(int);
                                    $('.date'+before).hide();
                                    $('.add').show();
                                    if(int == 1){
                                        $('.del').hide();
                                    }
                                });
                            </script>
                        </div>
                    </div>
                    <div class="item">
                        <label class="label" for="company">メールアドレス <span class="required_red">※<span></label>
                        <div>
                            {{ Form::text('contact_email', null, ['class'=>'inputs']) }}
                        </div>
                    </div>
                    <div class="item">
                        <label class="label" for="company">メールアドレス確認用 <span class="required_red">※<span></label>
                        <div>
                            {{ Form::text('contact_email_confirmation', null, ['class'=>'inputs']) }}
                        </div>
                    </div>
                    <div class="item">
                        <label class="label" for="company">電話番号 <span class="required_red">※<span></label>
                        <div>
                            {{ Form::text('contact_tel', null, ['class'=>'inputs']) }}
                        </div>
                    </div>
                    <div class="item">
                        <label class="label" for="company">郵便番号 <span class="required_red">※<span></label>
                        <div>
                            {{ Form::text('post_code', null, ['class'=>'inputs', 'id'=>'post_code']) }}
                            <button class="btn_04" type="button" onclick="addressSearch()">住所を検索</button>
                        </div>
                    </div>

                    <div class="item">
                        <label class="label" for="address">
                            住所 <span class="required_red">※<span>
                        </label>
                        <div>
                            {{ Form::text('contact_address', null, ['class'=>'inputs', 'id'=>'address']) }}
                        </div>
                    </div>

                    <div class="item">
                        <label class="label" for="company">お問い合わせ要件 <span class="required_red">※<span></label>
                        <div>
                            {{ Form::select('contact_requirement', config('custom.icon.requirement'), null) }}
                        </div>
                    </div>
                    <div class="item">
                        <label class="label" for="company">お問い合わせ内容 </label>
                        <div>
                            {{ Form::textarea('contact_contents', null, ['class'=>'inputs']) }}
                        </div>
                    </div>

                <div class="btn_area">
                    <button class="btn_flat" type="submit">送信内容を確認する</button>
                    <button class="btn_reset" type="reset" onclick="resetFileInput()">入力内容をリセット</button>
                </div>

                {{ Form::close() }}
                </div>
            </div>
        </div>
    </section>


    </main>
    <!-- //ここまでmain ********************************************************************************-->

@endsection
