@extends('admin.common.layout')

@section('title', '会社情報')

@section('contents')
{{ Form::open() }}
<main class="main_top">
    <div class="max975">
        <ol class="breadcrumb">
            <li>{{ link_to_route('wb-admin.dashboard', 'トップ') }}</li>
            <li><a href="">会社情報</a></li>
        </ol>
        <div class="wrapper">
            <h3>会社情報</h3>
            <div class="innerwrap">
                <table class="table_01 text_box box_outer">
                    <tr>
                        <th>会社名</th>
                        <td>{{ $company->name }}</td>
                    </tr>
                    <tr>
                        <th>電話番号</th>
                        <td>{{ $company->tel }}</td>
                    </tr>
                    <tr>
                        <th>郵便番号</th>
                        <td>{{ $company->zip_code }}</td>
                    </tr>
                    <tr>
                        <th>所在地</th>
                        <td>{{ $company->address }}</td>
                    </tr>
                    <tr>
                        <th>営業時間</th>
                        <td>{{ $company->biz_hours }}</td>
                    </tr>
                    <tr>
                        <th>定休日</th>
                        <td>{{ $company->closed }}</td>
                    </tr>
                    <tr>
                        <th>最寄駅1</th>
                        <td>{{ $company->station_1 }}</td>
                    </tr>
                    <tr>
                        <th>最寄駅2</th>
                        <td>{{ $company->station_2 }}</td>
                    </tr>
                    <tr>
                        <th>駐車場</th>
                        <td>{{ $company->parking }}</td>
                    </tr>
                    <tr>
                        <th>LINE URL</th>
                        <td>{{ $company->line }}</td>
                    </tr>
                    <tr>
                        <th>Twitter URL</th>
                        <td>{{ $company->twitter }}</td>
                    </tr>
                    <tr>
                        <th>Instagram URL</th>
                        <td>{{ $company->instagram }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="wrapper">
            <h3>会社概要</h3>
            <div class="innerwrap">
                <table class="table_01 text_box box_outer">
                    <tr>
                        <th>代表</th>
                        <td>{{ $company->president }}</td>
                    </tr>
                    <tr>
                        <th>設立</th>
                        <td>{{ $company->established }}</td>
                    </tr>
                    <tr>
                        <th>資本金</th>
                        <td>{{ $company->capital }}</td>
                    </tr>
                    <tr>
                        <th>事業内容</th>
                        <td>{{ $company->business }}</td>
                    </tr>
                    <tr>
                        <th>従業員数</th>
                        <td>{{ $company->employees }}</td>
                    </tr>
                    <tr>
                        <th>取引先</th>
                        <td>{{ $company->client }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="bt">
            <a class="bt_edit" href="{{ url('wb-admin/company/edit') }}">
                <span class="material-icons">edit</span>編集する
            </a>
        </div>
    </div>
</main>
{{ Form::close() }}
@endsection
