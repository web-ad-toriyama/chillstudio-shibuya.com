@include('admin.common.validation_error')

{{ Form::open() }}
<ul class="form_wrapper max600">
    <li>
        <label for="iconnews" class="ttl_min ic_required">お知らせアイコン</label>
        <div class="input_wrapper">
            <div class="select_box">
                {{ Form::select('icon', config('custom.icon.news'), $news->icon ?? '', ['id'=>'iconnews', 'class'=>'is-empty']) }}
            </div>
        </div>
        <div class="cl"></div>
    </li>
    <li>
        <label for="title" class="ttl_min ic_required">お知らせタイトル</label>
        <div class="input_wrapper">
            {{ Form::text('title', $news->title ?? '') }}
        </div>
        <div class="cl"></div>
    </li>
    <li>
        <label for="today" class="ttl_min ic_required">投稿日時</label>
        <div class="input_wrapper">
            <div class="reserve">
                <div class="reserve_box">
                    {{ Form::date('published_date', $published['date']) }}
                </div>
                <span></span>
                <div class="reserve_box">
                    {{ Form::time('published_time', $published['time']) }}
                </div>
            </div>
        </div>
        <div class="cl"></div>
    </li>
    <li>
        <label for="body" class="ttl_min ic_required">内容</label>
        <div class="input_wrapper">
            {{ Form::textarea('contents', ($news->contents ?? '')) }}
        </div>
        <div class="cl"></div>
    </li>
</ul>
<div class="fix_bt">
    {{ Form::button('変更を保存する', ['type'=>'submit', 'class'=>'bt_center']) }}
</div>
{{ Form::close() }}