@extends('backend.layouts.livewire.admin')

@section('content')
    <div class="box bt-1 border-success">
        <x-box-header back-text="{{ __('adding.card.card_designs_back') }}"
            title="{{ __('adding.card.design') }}"
            back-route="{{ route('admins.cards.design.index') }}" />
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">
                            {{ __('adding.card_design.name') }}
                        </label>
                        <div class="col-sm-9">
                            <input class="form-control set-card-name" data-name="card"
                                data-property="name" type="text" value="{{ $model['name'] }}">
                            <div class="help-block cardNameError" style="display: none">
                                <ul role="alert">
                                    <li>
                                        {{ __('adding.card_design.name_error') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cardSerialLabel" class="col-sm-3 col-6 col-form-label">
                            {{ __('adding.card_design.share') }}
                        </label>
                        <div class="col-sm-9 col-6">
                            <label class="switch switch-success">
                                <input class="share-card" type="checkbox" data-name="card"
                                    data-property="share"
                                    @if ($model['share'] == 1) checked @endif />
                                <span class="switch-indicator"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#serialContent"
                                role="tab">
                                <span>
                                    {{ __('adding.card_design.serial') }}
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#priceContent"
                                role="tab">
                                <span>
                                    {{ __('adding.card_design.price') }}
                                </span>
                            </a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content tabcontent-border">

                        <div class="tab-pane active" id="serialContent" role="tabpanel">

                            <div class="p-15">

                                <div class="form-group row">
                                    <label for="cardSerialLabel" class="col-sm-3 col-6  col-form-label">
                                        {{ __('adding.card_design.serialLabel') }}
                                    </label>
                                    <div class="col-sm-9 col-6">
                                        <input class="changeSerialValue form-control" type="text"
                                            value="{{ $model['itemsValue']['serial'] }}"
                                            data-name="serial" data-property="value">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="cardFontSizeLabel"
                                        class="col-sm-3 col-6 col-form-label">
                                        {{ __('adding.card_design.fontSizeLabel') }}
                                    </label>
                                    <div class="col-sm-9 col-6">
                                        <input class="item-change form-control" type="number"
                                            value="{{ $model['items']['items']['serial']['font-size'] }}"
                                            data-name="serial" data-property="font-size">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-sm-3 col-6">
                                        {{ __('adding.card_design.colorLabel') }}
                                    </label>
                                    <div class="col-sm-9 col-6">
                                        <input
                                            class="item-change form-control form-control-sm col-sm no-border"
                                            type="color"
                                            value="{{ $model['items']['items']['serial']['color'] }}"
                                            data-name="serial" data-property="color">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane" id="priceContent" role="tabpanel">
                            <div class="p-15">

                                <div class="form-group row">
                                    <label for="cardSerialLabel" class="col-sm-3 col-6 col-form-label">
                                        {{ __('adding.card_design.show') }}
                                    </label>
                                    <div class="col-sm-9 col-6">
                                        <label class="switch switch-success">
                                            <input class="show-item" type="checkbox" data-name="price"
                                                data-property="opacity"
                                                @if ($model['items']['items']['price']['opacity'] == 1) checked @endif />
                                            <span class="switch-indicator"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="cardFontSizeLabel"
                                        class="col-sm-3 col-6 col-form-label">
                                        {{ __('adding.card_design.fontSizeLabel') }}
                                    </label>
                                    <div class="col-sm-9 col-6">
                                        <input class="item-change form-control" type="number"
                                            value="{{ $model['items']['items']['price']['font-size'] }}"
                                            data-name="price" data-property="font-size">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-sm-3 col-6">
                                        {{ __('adding.card_design.colorLabel') }}
                                    </label>
                                    <div class="col-sm-9 col-6">
                                        <input
                                            class="item-change form-control form-control-sm col-sm no-border"
                                            type="color"
                                            value="{{ $model['items']['items']['price']['color'] }}"
                                            data-name="price" data-property="color">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
                <div class="col-md-6">
                    <div class="card-container-background" style="margin: auto">
                        <div id="cardContainer" class="card-container" dir="auto"
                            style="{{ $model['cardStyle'] }}">
                            <div class="cardItems draggable" id="serial" data-name="serial"
                                style="{{ $model['itemsStyle']['serial'] }}">
                                <div>
                                    {{ $model['itemsValue']['serial'] }}
                                </div>
                            </div>
                            <div class="cardItems draggable" id="price" data-name="price"
                                data-x="30" data-y="70"
                                style="{{ $model['itemsStyle']['price'] }}">
                                <div>
                                    {{ $model['itemsValue']['price'] }}
                                </div>
                            </div>
                        </div>
                        <div style="text-align: end;margin-top:2px">
                            <div class="form-group" dir="auto">
                                <label for="formFile" class="btn btn-success btn-sm">
                                    <i class="fa fa-image"></i>
                                    {{ __('adding.card_design.image') }}
                                </label>
                                <input class="form-control" type="file" id="formFile"
                                    style="visibility:hidden;" onchange="uploadedImage(this)">
                            </div>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->


                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
                <x-box-footer cancelRoute="{{ route('admins.offers.index') }}"
                    submitText="{{ __('website.save') }}" submitClass="btn-success addCardDesign" />
            </div>
        @endsection
        @push('scripts')
            <script>
                let cardData = @json($model['items']);
                localStorage.setItem(
                    "cardItems",
                    JSON.stringify(cardData)
                );
                let designId = "{{ $model['id'] }}";
            </script>
            <script src="https://unpkg.com/interactjs/dist/interact.min.js"></script>
            <script src="{{ asset('assets/includes/cards_edit.js') }}?2"></script>
        @endpush
