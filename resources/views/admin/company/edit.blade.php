@extends('admin.common.layout2')

@section('title', '会社情報の編集')

@section('contents')
<main>
    <ol class="breadcrumb">
        <li>{{ link_to_route('wb-admin.dashboard', 'トップ') }}</li>
        <li>{{ link_to_route('wb-admin.news.index', '会社情報') }}</li> {{-- リンク先変更　忘れないように！ --}}
        <li><a href="">編集</a></li>
    </ol>
    <section id="post_edit">
        <h2 class="hidden">投稿の編集</h2>
        <div class="wrapper">
            <div class="innerwrap">
                @include('admin.common.validation_error')
                {{ Form::open() }}
                <h3>会社情報</h3>
                <ul class="form_wrapper max600">
                    <li>
                        <label for="name" class="ttl_min ic_optional">会社名</label>
                        <div class="input_wrapper">
                            {{ Form::text('name', $company->name ?? '') }}
                        </div>
                        <div class="cl"></div>
                    </li>
                    <li>
                        <label for="tel" class="ttl_min ic_optional">電話番号</label>
                        <div class="input_wrapper">
                            {{ Form::text('tel', $company->tel ?? '') }}
                        </div>
                        <div class="cl"></div>
                    </li>
                    <li>
                        <label for="zip_code" class="ttl_min ic_optional">郵便番号</label>
                        <div class="input_wrapper">
                            {{ Form::text('zip_code', $company->zip_code ?? '') }}
                        </div>
                        <div class="cl"></div>
                    </li>
                    <li>
                        <label for="address" class="ttl_min ic_optional">所在地</label>
                        <div class="input_wrapper">
                            {{ Form::text('address', $company->address ?? '') }}
                        </div>
                        <div class="cl"></div>
                    </li>
                    <li>
                        <label for="biz_hours" class="ttl_min ic_optional">営業時間</label>
                        <div class="input_wrapper">
                            {{ Form::text('biz_hours', $company->biz_hours ?? '') }}
                        </div>
                        <div class="cl"></div>
                    </li>
                    <li>
                        <label for="closed" class="ttl_min ic_optional">定休日</label>
                        <div class="input_wrapper">
                            {{ Form::text('closed', $company->closed ?? '') }}
                        </div>
                        <div class="cl"></div>
                    </li>
                    <li>
                        <label for="station_1" class="ttl_min ic_optional">最寄駅1</label>
                        <div class="input_wrapper">
                            {{ Form::text('station_1', $company->station_1 ?? '') }}
                        </div>
                        <div class="cl"></div>
                    </li>
                    <li>
                        <label for="station_2" class="ttl_min ic_optional">最寄駅2</label>
                        <div class="input_wrapper">
                            {{ Form::text('station_2', $company->station_2 ?? '') }}
                        </div>
                        <div class="cl"></div>
                    </li>
                    <li>
                        <label for="parking" class="ttl_min ic_optional">駐車場</label>
                        <div class="input_wrapper">
                            {{ Form::text('parking', $company->parking ?? '') }}
                        </div>
                        <div class="cl"></div>
                    </li>
                    <li>
                        <label for="line" class="ttl_min ic_optional">LINE URL</label>
                        <div class="input_wrapper">
                            {{ Form::text('line', $company->line ?? '') }}
                        </div>
                        <div class="cl"></div>
                    </li>
                    <li>
                        <label for="twitter" class="ttl_min ic_optional">Twitter URL</label>
                        <div class="input_wrapper">
                            {{ Form::text('twitter', $company->twitter ?? '') }}
                        </div>
                        <div class="cl"></div>
                    </li>
                    <li>
                        <label for="instagram" class="ttl_min ic_optional">Instagram URL</label>
                        <div class="input_wrapper">
                            {{ Form::text('instagram', $company->instagram ?? '') }}
                        </div>
                        <div class="cl"></div>
                    </li>
                </ul>
                <h3>会社概要</h3>
                <ul class="form_wrapper max600">
                    <li>
                        <label for="president" class="ttl_min ic_optional">代表</label>
                        <div class="input_wrapper">
                            {{ Form::text('president', $company->president ?? '') }}
                        </div>
                        <div class="cl"></div>
                    </li>
                    <li>
                        <label for="established" class="ttl_min ic_optional">設立</label>
                        <div class="input_wrapper">
                            {{ Form::text('established', $company->established ?? '') }}
                        </div>
                        <div class="cl"></div>
                    </li>
                    <li>
                        <label for="capital" class="ttl_min ic_optional">資本金</label>
                        <div class="input_wrapper">
                            {{ Form::text('capital', $company->capital ?? '') }}
                        </div>
                        <div class="cl"></div>
                    </li>
                    <li>
                        <label for="business" class="ttl_min ic_optional">事業内容</label>
                        <div class="input_wrapper">
                            {{ Form::text('business', $company->business ?? '') }}
                        </div>
                        <div class="cl"></div>
                    </li>
                    <li>
                        <label for="employees" class="ttl_min ic_optional">従業員数</label>
                        <div class="input_wrapper">
                            {{ Form::text('employees', $company->employees ?? '') }}
                        </div>
                        <div class="cl"></div>
                    </li>
                    <li>
                        <label for="client" class="ttl_min ic_optional">取引先</label>
                        <div class="input_wrapper">
                            {{ Form::text('client', $company->client ?? '') }}
                        </div>
                        <div class="cl"></div>
                    </li>
                </ul>
                <div class="fix_bt">
                    {{ Form::button('変更を保存する', ['type'=>'submit', 'class'=>'bt_center']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </section>
</main>
@endsection
