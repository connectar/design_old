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
                            data-property="name" type="text" value="تصميم جديد"
                            wire:model="name">
                        <div class="help-block cardNameError" style="display: none">
                            <ul role="alert">
                                <li>
                                    {{ __('adding.card_design.name_error') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    @error('name')
                        <span class="error text-danger">
                            * {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3 form-group row">
                    <label for="formFile" class="col-sm-3 col-form-label">
                        اختر خلفيه
                    </label>
                    <div class="col-sm-9">
                        <input class="form-control" type="file" id="formFile"
                            wire:model="photo">
                    </div>
                    @error('photo')
                        <span class="error text-danger">
                            * {{ $message }}
                        </span>
                    @enderror
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
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#qrContent"
                            role="tab">
                            <span>
                                {{ __('adding.card_design.qr') }}
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
                                        value="999 999 99" data-name="serial" data-property="value">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <label for="cardFontSizeLabel" class="">
                                        {{ __('adding.card_design.fontSizeLabel') }}
                                    </label>
                                    <div class="">
                                        <input class="item-change form-control" type="number"
                                            value="14" data-name="serial"
                                            data-property="font-size">
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="">
                                        {{ __('adding.card_design.colorLabel') }}
                                    </label>

                                    <input class="item-change form-control p-0" type="color"
                                        value="#563d7c" data-name="serial" data-property="color"
                                        style="height: 32px;">
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
                                            data-property="opacity" checked />
                                        <span class="switch-indicator"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label for="cardFontSizeLabel">
                                        {{ __('adding.card_design.fontSizeLabel') }}
                                    </label>
                                    <input class="item-change form-control" type="number"
                                        value="14" data-name="price" data-property="font-size">
                                </div>
                                <div class="col">
                                    <label>
                                        {{ __('adding.card_design.colorLabel') }}
                                    </label>
                                    <input class="item-change form-control p-0" type="color"
                                        value="#563d7c" data-name="price" data-property="color"
                                        style="height: 32px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="qrContent" role="tabpanel">
                        <div class="p-15">
                            <div class="form-group row">
                                <label for="cardSerialLabel" class="col-sm-3 col-6 col-form-label">
                                    {{ __('adding.card_design.show') }}
                                </label>
                                <div class="col-sm-9 col-6">
                                    <label class="switch switch-success">
                                        <input class="show-item" type="checkbox" data-name="qr"
                                            data-property="opacity" />
                                        <span class="switch-indicator"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label for="cardFontSizeLabel">
                                        {{ __('adding.card_design.widthLabel') }}
                                    </label>
                                    <input class="item-change form-control" type="number"
                                        value="75" data-name="qr" data-property="width">
                                </div>
                                <div class="col">
                                    <label for="cardFontSizeLabel">
                                        {{ __('adding.card_design.heightLabel') }}
                                    </label>
                                    <input class="item-change form-control" type="number"
                                        value="75" data-name="qr" data-property="height">
                                </div>
                                {{-- <div class="col">
                                    <label>
                                        {{ __('adding.card_design.colorLabel') }}
                                    </label>
                                    <input class="item-change form-control p-0" type="color"
                                        value="#563d7c" data-name="qr" data-property="color"
                                        style="height: 32px;">
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-md-6 -->
            <div class="col-md-6">
                <div class="card-container-background" style="margin: auto">
                    <div id="cardContainer" class="card-container" dir="auto">
                        <div class="cardItems draggable" id="serial" data-name="serial"
                            style="font-size: 14pt;">
                            <div>
                                99999999
                            </div>
                        </div>
                        <div class="cardItems draggable" id="qr" data-name="qr"  data-x="30" data-y="70" style="opacity: 0;">
                            <div style="position: relative; width: 100%; height: 100%;">
                                <img src="data:image/svg+xml;base64,{!! $qr !!}" style="width: 100%; height: 100%;">
                            </div>
                        </div>
                        <div class="cardItems draggable" id="price" data-name="price"
                            data-x="30" data-y="70"
                            style="left:30px;top:70px;font-size: 14pt;">
                            <div>
                                80
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <x-box-footer cancelRoute="{{ route('admins.cards.design.index') }}"
        submitText="{{ __('website.save') }}" submitClass="btn-success addCardDesign" />
</div>
