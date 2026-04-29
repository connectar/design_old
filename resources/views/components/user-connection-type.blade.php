<select class="selectpicker form-select show-tick p-0" name="userData[connection_type]">
    @foreach ($connectionTypes as $value => $name)
    <option value="{{ $value }}" @if(isset($selected) && $value == $selected) selected @endif>{{ $name }}</option>
    @endforeach
</select>
