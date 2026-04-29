@extends('backend.layouts.admin')

@section('content')
<form id="FormSubmit" action="{{ route('admins.charging.store') }}" method="POST">
    @method('POST')
    @csrf
    <div class="box bt-1 border-success">
        <x-box-header back-text="{{ __('adding.card.back_title') }}" title="{{ __('adding.card.create_title') }}"
            back-route="{{ route('admins.cards.groups.index') }}" />
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row" x-data="addNewCardCharging">
                {{-- nas serial --}}
                <div class="col-md-4 col-sm-6">
                    <div class="form-group row">
                        <label for="nas_serial" class="form-label">
                            {{ __('adding.card.nas_name') }}
                        </label>
                        <div>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-server text-info"></i>
                                </div>
                                <select class="selectpickerJs form-select show-tick p-0" name="nas">
                                    @foreach ($allNas as $nas)
                                    <option value="{{ $nas['serial'] }}">
                                        {{ $nas['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="form-group row">
                        <label for="speed" class="form-label fw-bold">
                            {{ __('adding.cards_charging.price_title') }}
                        </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-money text-danger"></i>
                            </div>
                            <div class="input-group-addon p-0 form-control">
                                <div class="dropdown ">
                                    <button class="btn btn-md text-white dropdown-toggle no-caret" type="button"
                                        data-bs-toggle="dropdown" style="min-width: 100%">
                                        {{ __('adding.cards_charging.add_price') }}
                                    </button>
                                    <div class="dropdown-menu scrollable-menu">
                                        <a href="#" x-on:click="changePrice('add_price')">
                                            <span class="dropdown-item text-white">
                                                <span>
                                                    {{ __('adding.cards_charging.add_price') }}
                                                </span>
                                            </span>
                                        </a>
                                        @foreach ($prices as $array)
                                        @if ($array['price'] == 'offers' || $array['price'] == 'quta')
                                        <h6 class="dropdown-header text-danger">
                                            {{ __("adding.cards_charging.{$array['price']}_title") }}
                                        </h6>
                                        @else
                                        <a href="#" x-on:click="changePrice('{{ $array['price'] }}')">
                                            <span class="dropdown-item text-white">
                                                <span class="badge fs-16 badge-success py-1">
                                                    {{ $array['price'] . ' جنيه' }}
                                                </span>
                                                {{ $array['name'] }}
                                            </span>
                                        </a>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="form-group row">
                        <label for="paid_price" class="form-label">
                            {{ __('adding.card.paid_price') }}
                        </label>
                        <div>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-money text-success"></i>
                                </div>
                                <input class="form-control" type="number" id="paid_price" name="price"
                                    x-bind:readonly="priceDisable">
                            </div>
                        </div>
                    </div>

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
                                    <i class="fa fa-calculator text-primary"></i>
                                </div>
                                <input class="form-control" value="1" type="text" min="1" name="cardsCount">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="form-group row">
                        <label for="serial_length" class="form-label">@lang('adding.card.serial_length')</label>
                        <div>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calculator text-white"></i>
                                </div>
                                <select class="selectpickerJs form-select show-tick p-0" name="pin">
                                    @foreach ($serialLength as $length)
                                    <option value="{{ $length }}">
                                        {{ $length }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                @if (authIsAdmin())
                <div class="col-md-4">
                    <div class="form-group row">
                        <label for="distributor" class="form-label">
                            @lang('adding.card.distributor')
                        </label>
                        <div>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-user text-dark"></i>
                                </div>
                                <select class="selectpickerJs form-select show-tick p-0" name="distributor">
                                    @foreach ($distributors as $distributor)
                                    <option value="{{ $distributor['id'] }}">
                                        {{ $distributor['fullname'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

        </div>
        <!-- /.box-body -->
        <x-box-footer cancelRoute="{{ route('admins.cards.groups.index') }}" submitText="{{ __('website.save') }}" />
    </div>
</form>
@endsection
@push('scripts')
<script src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}">
</script>
<script src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/i18n/defaults-ar_AR.js') }}">
</script>
<script src="{{asset('assets/main.js')}}"></script>
<script src="{{ asset('assets/includes/selectPicker.js') }}"></script>
<script>
    function addNewCardCharging() {
            return {
                priceDisable: false,
                changePrice(value) {
                    this.priceDisable = value == 'add_price' ? false : true;
                    $('#paid_price').val(value);
                }
            }
        }
</script>
@endpush
