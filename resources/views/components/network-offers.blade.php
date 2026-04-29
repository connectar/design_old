@foreach ($offers as $offer )
<option value="{{$offer['id']}}" @if(isset($selectedOffer) && $offer['id']==$selectedOffer) selected @endif>
    {{ $offer['name'] }}</option>
@endforeach
