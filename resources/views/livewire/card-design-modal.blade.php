<div class="box b-1 border-info m-0 no-padding">
    <div class="box-header with-border py-2">
        <h4 class="box-title">
            <span class="text-white">
                {{ __('site.card_design_export.title') }}
            </span>
        </h4>
        @if ($step == 1)
            <a href="#" data-bs-dismiss="modal" class="btn btn-sm btn-danger pull-right">
                @lang('website.cancel')
            </a>
        @endif
    </div>
    <!-- /.box-header -->
    @if ($step == 1)
        @if (count($cardDesigns))
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="connection_type" class="form-label">
                                {{ __('site.card_design_export.number_of_col') }}
                            </label>
                            <div>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-wifi"></i>
                                    </div>
                                    <select class="form-select" wire:model="totalColumns">
                                        @for ($i = 1, $total = 10; $i <= $total; $i++)
                                            <option value="{{ $i }}">
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="connection_type" class="form-label">
                                {{ __('site.card_design_export.number_of_rows') }}
                            </label>
                            <div>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-wifi"></i>
                                    </div>
                                    <select class="form-select" wire:model="totalRows">
                                        @for ($i = 1, $total = 15; $i <= $total; $i++)
                                            <option value="{{ $i }}">
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row">
                            <label for="connection_type" class="form-label">
                                {{ __('site.card_design_export.choose_design') }}
                            </label>
                            <div>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-wifi"></i>
                                    </div>
                                    <select class="form-select" wire:model="selectedDesign">
                                        @foreach ($cardDesigns as $index => $array)
                                            <option value="{{ $array['id'] }}">
                                                {{ $array['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p class="mb-1">
                            {{ __('site.card_design_export.show_design') }}
                        </p>
                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body card-container-background" dir="auto">

                                <div id="cardContainer" class="card-container">
                                    <div class="cardItems" id="cardSerialItem">
                                        <div>
                                            12398712
                                        </div>
                                    </div>
                                    <div class="cardItems" id="cardQrItem"  style="opacity: 0;">
                                        <div>
                                            <img src="data:image/svg+xml;base64,{!! $qr !!}" >
                                        </div>
                                    </div>
                                    <div class="cardItems" id="cardPriceItem">
                                        <div>
                                            $80
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer p-2">
                <a href="{{ route('admins.cards.design.create') }}" class="btn btn-success">
                    <i class="fa spi fa-plus px-2"></i>
                    @lang('site.card_groups_index.add_new_design')
                </a>
                <div class="pull-right">
                    <a href="#" data-bs-dismiss="modal" class="btn btn-danger">
                        @lang('website.cancel')
                    </a>
                    <button type="button" wire:click="downloadAsPdf" class="btn btn-success mx-1">
                        <i class="fa spi fa-cloud-download"></i>
                        {{ __('site.card_groups_index.download') }}
                    </button>
                </div>
            </div>
        @else
            {{-- <div class="box text-center"> --}}
            <div class="box-body py-50 text-center">
                <span class="fw-bold text-danger fs-18">
                    👀 {{ __('site.empty.designs') }}
                </span>
                <a href="{{ route('admins.cards.design.create') }}" class="btn btn-success">
                    {{ __('site.empty.from_here') }}
                </a>
            </div>
            {{-- </div> --}}
        @endif
    @else
        {{-- <div class="box text-center"> --}}
        <div class="box-body py-50 text-center">
            <div>
                <span class="fw-bold text-success fs-18">
                    تم طباعه الكروت بنجاح
                </span>
            </div>
            <div class="py-2">
                <a href="{{ route('admins.cards.groups.index') }}" class="btn btn-success">
                    {{ __('site.close') }}
                </a>
            </div>
        </div>
        {{-- </div> --}}
    @endif
</div>
