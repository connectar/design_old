<div>
    <div id="chat-box-body">
        <div id="chat-circle"
            class="btn btn-circle btn-lg bg-success-light h-40 w-40 rounded-circle l-h-40"
            style="bottom:100px;left:5px;z-index:3000">
            <div id="chat-overlay"></div>
            <i class="fa fa-gear fs-25"></i>
        </div>

        <div class="chat-box b-1 bs-3 border-success" style="bottom:100px">
            <div class="chat-box-header p-1">
                <div class="chat-box-toggle d-flex flex-row-reverse">
                    <button id="chat-box-toggle"
                        class="waves-effect waves-circle btn btn-sm btn-circle btn-warning rounded-circle"
                        type="button">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
            </div>
            <div class="chat-box-body py-5">
                <div class="chat-box-overlay">
                </div>
                <div class="p-15">
                    <div class="row">
                        <div class="col-12 bb-3 border-dark pb-3">
                            <span class="badge badge-info d-block mb-2">
                                {{ __('site.user_index.statistic.online_total') }}
                                <span class="pe-2 fw-bold">
                                    {{ $onlineCount ?? 0 }}
                                </span>
                            </span>
                            <div class="d-flex flex-row justify-content-between">
                                @foreach ($statistic as $key => $data)
                                    <span class="badge badge-{{ $data['color'] }}">
                                        <span class="pe-2">
                                            {{ $key }}
                                        </span>
                                        <span class="fw-bold">
                                            {{ $data['value'] }}
                                        </span>
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="type" class="form-label">
                                    اختر سيرفر
                                </label>
                                <div>
                                    <select class="form-select" wire:model.live="selectedNas">
                                        @foreach ($nas as $index => $nas)
                                            <option value="{{ $nas['serial'] }}">{{ $nas['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <label>
                                    عدد النتائج
                                </label>
                                <div>
                                    <select aria-controls="complex_header"
                                        class="form-select form-control-sm" wire:model.live="perPage">
                                        @foreach ($menuItems as $item)
                                            <option value="{{ $item }}">{{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex flex-row justify-content-center">
                            {{ $paginatedData->onEachSide(1)->links('vendor.pagination.livewire.crypto_paginate') }}
                        </div>
                    </div>
                    <!--chat-log -->
                </div>
            </div>
        </div>
    </div>
</div>
