<div id="contact_form_template" hidden>
    <ul class="form_wrapper max600">
        <li>
            <label for="title" class="ttl_min ic_required">項目名</label>
            <div class="input_wrapper">
                {{ Form::text('title[]') }}
            </div>
            <div class="cl"></div>
            <p class="contact_error error_title"></p>
        </li>
        <li>
            <label for="required" class="ttl_min ic_required">入力</label>
            <div class="input_wrapper">
                @foreach (config('custom.contact.required') as $key => $value)
                    {{ Form::radio('required[]', $key, ($key == 1) ? true : false, ['class' => 'contact_required']) }}{{ $value }}
                @endforeach
            </div>
            <div class="cl"></div>
            <p class="contact_error error_required"></p>
        </li>
        <li>
            <label for="format" class="ttl_min ic_required">入力形式</label>
            <div class="input_wrapper">
                {{ Form::select('format[]', config('custom.contact.format'), null, ['class' => 'contact_format']) }}
            </div>
            <div class="cl"></div>
        </li>
        <p class="contact_error error_format"></p>
        <li class="contact_select_option hidden">
            <label for="select1" class="ttl_min ic_required">選択肢1</label>
            <div class="input_wrapper">
                {{ Form::text('select1[]') }}
            </div>
            <div class="cl"></div>
            <p class="contact_error error_select1"></p>
        </li>
        <li class="contact_select_option hidden">
            <label for="selectd2" class="ttl_min ic_required">選択肢2</label>
            <div class="input_wrapper">
                {{ Form::text('select2[]') }}
            </div>
            <div class="cl"></div>
            <p class="contact_error  error_select2"></p>
        </li>
        <li class="contact_select_option hidden">
            <label for="select3" class="ttl_min ic_optional">選択肢3</label>
            <div class="input_wrapper">
                {{ Form::text('select3[]') }}
            </div>
            <div class="cl"></div>
        </li>
        <li class="contact_select_option hidden">
            <label for="select4" class="ttl_min ic_optional">選択肢4</label>
            <div class="input_wrapper">
                {{ Form::text('select4[]') }}
            </div>
            <div class="cl"></div>
        </li>
        <li class="contact_select_option hidden">
            <label for="select5" class="ttl_min ic_optional">選択肢5</label>
            <div class="input_wrapper">
                {{ Form::text('select5[]') }}
            </div>
            <div class="cl"></div>
        </li>
        <li class="contact_text_option hidden">
            <label for="option" class="ttl_min ic_optional">入力条件</label>
            <div class="input_wrapper">
                {{ Form::select('option[]', config('custom.contact.option'), null, ['class' => 'contact_option', 'placeholder' => '選択してください']) }}
            </div>
            <div class="cl"></div>
        </li>
        <li class="contact_text_option hidden">
            <label for="max" class="ttl_min ic_optional">最大文字数</label>
            <div class="input_wrapper">
                {{ Form::text('max[]') }}
            </div>
            <div class="cl"></div>
        </li>
        <p class="contact_error error_max"></p>
        <li class="contact_text_option hidden">
            <label for="min" class="ttl_min ic_optional">最小文字数</label>
            <div class="input_wrapper">
                {{ Form::text('min[]') }}
            </div>
            <div class="cl"></div>
            <p class="contact_error error_min"></p>
        </li>
    </ul>
</div>
