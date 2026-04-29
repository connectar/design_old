<div class="box border-success m-0">
    <!-- /.box-header -->
    <div class="box-body">
        <div class="p-2">
            @error('userId')
                <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group row">
                    <label for="fullname" class="col-sm-2 col-form-label">
                        {{ __('adding.user_option.change_offer_date') }}
                    </label>
                    <div class="col-sm-10">
                        <select class="form-select" wire:model="dateRangeSelected">
                            @foreach ($dateRanges as $key => $langKey)
                                <option value="{{ $key }}">
                                    {{ $langKey }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @error('expired_at')
                    <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>
            @if ($showPickAday)
                <div class="col-12">
                    <div class="form-group row">
                        <label for="fullname" class="col-sm-2 col-form-label">
                            {{ __('adding.user_option.change_offer_started_at') }}
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="datepicker"
                                wire:model.lazy="other_date">
                        </div>
                    </div>
                    @error('other_date')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
            @endif
            <div class="col-12">
                <div class="form-group row">
                    <label for="fullname" class="col-sm-2 col-form-label">
                        المبلغ المطلوب
                    </label>
                    <div class="col-sm-10">
                        <span class="badge text-danger fs-18">
                            {{ $offerPrice ?? 0 }}
                        </span>
                    </div>
                </div>
                @error('expired_at')
                    <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-12">
                <div class="form-group row">
                    <label for="fullname" class="col-sm-2 col-form-label">
                        المبلغ المدفوع
                    </label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text"
                            placeholder="اكتب ما دفعه العميل لك" wire:model.lazy="paied_price">
                        @error('paied_price')
                            <span class="error text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label for="note">
                    {{ __('adding.user.notes') }}
                </label>
                <div class="input-group">
                    <span class="input-group-addon vertical-align">
                        <i class="fa fa-bookmark">
                        </i>
                    </span>
                    <textarea class="form-control" rows="3" id="notes" wire:model.lazy="notes"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
