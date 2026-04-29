@extends('backend.layouts.livewire.cafe')

@section('content')
    <form method="post" id="upload_form" enctype="multipart/form-data">
        <div class="box bt-1 border-success">
            <x-box-header back-text="{{ __('adding.card.card_designs_back') }}"
                title="{{ __('adding.card.design') }}"
                back-route="{{ route('cafe.cards.design.index') }}" />
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
                                    data-property="name" type="text" value="تصميم جديد">
                                <div class="help-block cardNameError" style="display: none">
                                    <ul role="alert">
                                        <li>
                                            {{ __('adding.card_design.name_error') }}
                                        </li>
                                    </ul>
                                </div>
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
                                        <label for="cardSerialLabel"
                                            class="col-sm-3 col-6  col-form-label">
                                            {{ __('adding.card_design.serialLabel') }}
                                        </label>
                                        <div class="col-sm-9 col-6">
                                            <input class="changeSerialValue form-control" type="text"
                                                value="999 999 99" data-name="serial"
                                                data-property="value">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="cardFontSizeLabel"
                                            class="col-sm-3 col-6 col-form-label">
                                            {{ __('adding.card_design.fontSizeLabel') }}
                                        </label>
                                        <div class="col-sm-9 col-6">
                                            <input class="item-change form-control" type="number"
                                                value="14" data-name="serial" data-property="font-size">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-3 col-6">
                                            {{ __('adding.card_design.colorLabel') }}
                                        </label>
                                        <div class="col-sm-9 col-6">
                                            <input
                                                class="item-change form-control form-control-sm col-sm no-border"
                                                type="color" value="#563d7c" data-name="serial"
                                                data-property="color">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane" id="priceContent" role="tabpanel">
                                <div class="p-15">

                                    <div class="form-group row">
                                        <label for="cardSerialLabel"
                                            class="col-sm-3 col-6 col-form-label">
                                            {{ __('adding.card_design.show') }}
                                        </label>
                                        <div class="col-sm-9 col-6">
                                            <label class="switch switch-success">
                                                <input class="show-item" type="checkbox"
                                                    data-name="price" data-property="opacity" checked />
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
                                                value="14" data-name="price" data-property="font-size">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-3 col-6">
                                            {{ __('adding.card_design.colorLabel') }}
                                        </label>
                                        <div class="col-sm-9 col-6">
                                            <input
                                                class="item-change form-control form-control-sm col-sm no-border"
                                                type="color" value="#563d7c" data-name="price"
                                                data-property="color">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                    <div class="col-md-6">
                        <div class="card-container-background" style="margin: auto">
                            <div id="cardContainer" class="card-container" dir="auto">
                                <div class="cardItems draggable" id="serial" data-name="serial">
                                    <div>
                                        99999999
                                    </div>
                                </div>
                                <div class="cardItems draggable" id="price" data-name="price"
                                    data-x="30" data-y="70" style="left:30px;top:70px;">
                                    <div>
                                        80 $
                                    </div>
                                </div>
                            </div>
                            <div style="text-align: end;margin-top:2px">
                                <div class="form-group" dir="auto">
                                    <label for="formFile" class="btn btn-success btn-sm">
                                        <i class="fa fa-image"></i>
                                        {{ __('adding.card_design.image') }}
                                    </label>
                                    <input class="form-control" type="file" id="formFile" name="image"
                                        style="visibility:hidden;" onchange="loadFile(event)">
                                </div>
                            </div>
                        </div>
                        <!-- /.col-md-6 -->


                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <x-box-footer cancelRoute="{{ route('cafe.offers.index') }}"
                submitText="{{ __('website.save') }}" submitClass="btn-success addCardDesign" />
        </div>
    </form>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
    <script src="{{ asset('assets/includes/cafe_cards_create.js') }}?2"></script>
@endpush
