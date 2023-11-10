{{ Form::open(['enctype'=>'multipart/form-data']) }}
@include('admin.common.validation_error')
<meta name="csrf-token" content="{{ csrf_token() }}">
<ul class="form_wrapper max600">
    <li>
        <label for="title" class="ttl_min ic_required">投稿タイトル</label>
        <div class="input_wrapper">
            {{ Form::text('title', $post->title ?? '') }}
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
        <b class="ttl_min ic_optional">サムネイル画像</b>
        <p class="font_annot_12">サイトの投稿一覧などでタイトルと一緒に表示される画像です。</p>
        <div class="upload_box">
            <label class="file_up" for="bt_file">
                <div id="preview_box">
                    @if ($post->file_path ?? '')
                        <img id="preview_img" src="{{ Storage::disk('post')->url($post->file_path) }}" alt="">
                    @endif
                </div>
                <p class="file_up_text"><span class="material-icons">photo_camera</span>画像を選択する</p>
                @if ($post->file_path ?? '')<label class="img_del">{{ Form::checkbox('file_del') }}画像を削除する</label>@endif
                {{ Form::file('file', ['id'=>'bt_file','accept'=>'image/*','onchange'=>'loadImage(this);']) }}
            </label>
        </div>
        <div class="cl"></div>

    </li>
    <li>
        <label for="body" class="ttl_min ic_required">内容</label>
        <p class="font_annot_12">上部パネルから文字の装飾や画像の挿入が可能です。</p>
        <div class="input_wrapper">
            {{ Form::textarea('contents', ($post->contents ?? ''), ['id'=>'ckeditor']) }}
            {{ Form::hidden('file_path', ($post->file_path ?? '')) }}
        </div>
        <div class="cl"></div>
    </li>
</ul>
<div class="fix_bt">
    {{ Form::button('変更を保存する', ['type'=>'submit', 'class'=>'bt_center']) }}
</div>
{{ Form::close() }}
