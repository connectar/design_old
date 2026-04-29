@foreach ($nas as $nas )
<option value="{{$nas['serial']}}" @if(isset($selected) && $nas ==$selected) selected @endif>
    {{ $nas['name'] }}
</option>
@endforeach
