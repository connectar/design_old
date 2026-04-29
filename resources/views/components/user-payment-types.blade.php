<select class="selectpicker form-select show-tick p-0" name="userData[payment_type]">
    @foreach ($paymentTypes as $value => $name)
    <option value="{{ $value }}">{{ $name }}</option>
    @endforeach
</select>
