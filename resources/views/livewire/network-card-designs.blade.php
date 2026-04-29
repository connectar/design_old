<div class="bg-dark bg-brick-white p-1">
    @if (count($designs))
        <div class="row" style="margin-top: 5px;margin-bottom: 10px">
            <div class="col-sm-12 col-md-6">
                <a href="{{ route('admins.cards.design.create') }}"
                    class="btn btn-success btn-md ml-5 fw-bold">
                    <i class="fa spi fa-plus px-2"></i>
                    {{ __('adding.card_design.add_design') }}
                </a>
            </div>
        </div>
        <div class="row">
            @foreach ($designs as $index => $design)
                <div class="col-lg-4 col-sm-6">
                    <div
                        class="box text-center @if (($index + 1) % 2 == 0) bt-1 @else bb-1 @endif border-success">
                        <div class="box-body p-0">
                            <h3 class="box-title py-2">
                                <span class="text-primary tex-bold">
                                    {{ $design['name'] }}
                                </span>
                            </h3>
                            <div class="card-container-background" style="margin: auto">
                                <div id="cardContainer" class="card-container" dir="auto"
                                    style="{{ $design['cardStyle'] }}">
                                    @foreach ($design['items']['items'] as $key => $item)
                                    @if ($key === "qr")
                                        <div class="cardItems"  style="{{ $design['itemsStyle'][$key] }}" >
                                            <img src="data:image/svg+xml;base64,{!! $qr !!}" style="width:{{ $design['items']['items']['qr']['width'] ?? '200' }};height:{{ $design['items']['items']['qr']['height'] ?? '200' }}">
                                        </div>
                                    @else
                                        <div class="cardItems"
                                            style="{{ $design['itemsStyle'][$key] }}">
                                            <div dir="auto">
                                                {{ $design['itemsValue'][$key] }}
                                            </div>
                                        </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="box-footer justify-content-center d-flex no-border">
                            {{-- <a class="btn btn-sm btn-info mx-2"
                                href="{{ route('admins.cards.design.edit', $design['id']) }}">
                                <i class="fa fa-pencil"></i>
                                {{ __('site.edit') }}
                            </a> --}}
                            <a class="btn btn-sm btn-danger"
                                wire:click="showDeletedBox('{{ $design['id'] }}')">
                                <i class="fa fa-trash-o"></i>
                                {{ __('site.delete') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="box bt-3 border-primary text-center">
            <div class="box-body py-50">
                <span class="fw-bold text-danger fs-18">
                    👀 {{ __('site.empty.designs') }}
                </span>
                <a href="{{ route('admins.cards.design.create') }}" class="btn btn-success">
                    {{ __('site.empty.from_here') }}
                </a>
            </div>
        </div>
    @endif
</div>
