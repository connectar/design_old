<div class="row">
    <div class="col-md-4 col-sm-6">
        <div class="form-group row">
            <label for="phone" class="form-label">
                {{ __('adding.setting.change_lang') }}
            </label>
            <div>
                <div>
                    <div class="input-group p-0">
                        <div class="input-group-addon">
                            <i class="fa fa-flash text-danger"></i>
                        </div>
                        <select class="form-select" id="locale" name="locale">
    {{-- $locale_ is variable that get from ManagerSettingController, index method that get the current user database langauge like "ar" --}}
                            <option value="{{ $locale_ }}">
                                {{ __("languages.locale.$locale_.name") }}
                            </option>
                            @foreach (__('languages.locale') as $locale)
                                @if($locale_ != $locale['locale'])
                                    <option value="{{ $locale['locale'] }}">
                                        {{ $locale['name'] }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                @error('type')
                    <span class="error text-danger">{{ $message }}</span>
                @enderror

            </div>
        </div>
    </div>
</div>
