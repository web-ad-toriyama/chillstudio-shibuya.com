@foreach ($contact as $item)
@foreach ($item as $key => $value)
[{{ $key }}] {{-- 項目名 ( 例:[お名前] ) --}}
@if (is_array($value))
{{ implode(',', $value) }} {{-- 内容 ( 例:選択肢1,選択肢2,選択肢3 ) --}}

@else
{{ $value }} {{-- 内容 ( 例:ウェヴァード太郎 ) --}}

@endif
@endforeach
@endforeach
