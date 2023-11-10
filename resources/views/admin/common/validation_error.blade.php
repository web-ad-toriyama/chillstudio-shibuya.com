@if ($errors->any())
<ul class="err_box">
    @foreach ($errors->all() as $error)
        <li class="form_err_msg">{{ $error }}</li>
    @endforeach
</ul>
@endif