<form wire:submit="save" novalidate>
    <div class="box bt-1 border-success">
        <x-box-header back-text="{{ __('adding.card.back_title') }}"
            title="{{ __('adding.card.create_title') }}"
            back-route="{{ route('cafe.cards.groups.index') }}" />
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                {{-- nas serial --}}
                <div class="col-md-4 col-sm-6">
                    <div class="form-group row">
                        <label for="nas_serial" class="form-label">
                            {{ __('adding.card.nas_name') }}
                        </label>
                        <div>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-server"></i>
                                </div>
                                <select class="selectpickerJs form-select show-tick p-0"
                                    wire:model="nas">
                                    @foreach ($allNas as $nas)
                                        <option value="{{ $nas['serial'] }}">
                                            {{ $nas['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @error('nas')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- offer name --}}
                <div class="col-md-4 col-sm-6">
                    <div class="form-group row">
                        <label for="offer_id" class="form-label">
                            {{ __('adding.card.offer_id') }}
                        </label>
                        <div>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-tags"></i>
                                </div>
                                <select class="selectpickerJs form-select show-tick p-0"
                                    wire:model="offer">
                                    @foreach ($offers as $offer)
                                        <option value="{{ $offer['id'] }}">
                                            {{ $offer['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @error('offer')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="form-group row">
                        <label for="paid_price" class="form-label">
                            {{ __('adding.card.paid_price') }}
                        </label>
                        <div>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-money"></i>
                                </div>
                                <input class="form-control" type="number" id="paid_price"
                                    wire:model="price" value="{{ $price }}" readonly>
                            </div>
                        </div>
                    </div>
                    @error('price')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div><!-- end of row-->
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="form-group row">
                        <label for="cards_num" class="form-label">
                            {{ __('adding.card.cards_num') }}
                        </label>
                        <div>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calculator"></i>
                                </div>
                                <input class="form-control" type="text" min="1"
                                    wire:model="cardsCount">
                            </div>
                        </div>
                    </div>
                    @error('cardsCount')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="form-group row">
                        <label for="serial_length"
                            class="form-label">@lang('adding.card.serial_length')</label>
                        <div>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calculator"></i>
                                </div>
                                <select class="selectpickerJs form-select show-tick p-0"
                                    wire:model="pin">
                                    @foreach ($serialLength as $length)
                                        <option value="{{ $length }}">
                                            {{ $length }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @error('pin')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div> <!-- end of row-->

        </div>
        <!-- /.box-body -->
        <x-box-footer cancelRoute="{{ route('cafe.cards.groups.index') }}"
            submitText="{{ __('website.save') }}" />
    </div>
</form>
@push('scripts')
    <script
        src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}">
    </script>
    <script
        src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/i18n/defaults-ar_AR.js') }}">
    </script>
    <script src="{{ asset('assets/includes/cards.js') }}"></script>
@endpush
