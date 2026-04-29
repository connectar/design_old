<option value="0">{{ __('adding.user.map_without_device') }}</option>
@foreach ($maps as $name =>$id )
<option value="{{$id}}" @if(isset($selected) && $id == $selected) selected @endif>{{ $name }}</option>
@endforeach
