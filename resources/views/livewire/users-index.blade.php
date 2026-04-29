<div>
    <div>
        @include('backend.admins.users.includes.tables')
    </div>
    <div>
        {{-- @include('backend.admins.users.includes.mobile') --}}
    </div>

    <!-- Modal -->
    <div class="modal center-modal fade" id="usersIndexModal" tabindex="-1" wire:ignore>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header py-1">
                    <h5 class="modal-title">الاعدادات</h5>
                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa fa-close fs-25"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" x-show="showSetting">
                        <div class="col-6 mb-3">
                            @can('user_delete')
                                @if (authIsSuperAdmin())
                                <a class="btn btn-sm btn-danger d-block" href="#"
                                    @click="doAction('deleteCollection',true)">
                                    <i class="fa fa-trash-o"></i>
                                    {{ __('site.user_index.option.delete') }}
                                </a>
                                @endif
                            @endcan
                        </div>
                        <div class="col-6 mb-3">
                            @can('user_renewUser')
                                <a class="btn btn-info btn-sm d-block" href="#"
                                    @click="doAction('renewCollectionOfUsers')">
                                    <i class="fa spi fa-money"></i>
                                    {{ __('site.user_index.option.renew') }}
                                </a>
                            @endcan
                        </div>
                        <div class="col-6 mb-3">
                            <a class="btn btn-sm btn-secondary d-block text-black" href="#"
                                @click="doAction('editQutaForCollection')">
                                <i class="fa spi fa-cloud-download"></i>
                                {{ __('site.user_index.option.change_quta') }}
                            </a>
                        </div>
                        <div class="col-6 mb-3">
                            <a class="btn btn-sm btn-info d-block " href="#"
                                @click="doAction('ChangeOfferForCollectionOfUsers')">
                                <i class="fa spi fa-retweet"></i>
                                {{ __('site.user_index.option.change_offer') }}
                            </a>
                        </div>
                        <div class="col-6 mb-3">
                            @can('user_editExpiredDate')
                                <a class="btn btn-sm btn-danger d-block" href="#"
                                    @click="doAction('editExpiredDateForCollection')">
                                    <i class="fa spi fa-calendar"></i>
                                    {{ __('site.user_index.option.change_expired_date') }}
                                </a>
                            @endcan
                        </div>

                        <div class="col-6 mb-3">
                            <a class="btn btn-sm btn-success d-block" href="#"
                                @click="doAction('moveUsersToNas')">
                                <i class="fa fa-rocket"></i>
                                {{ __('site.user_index.option.move_to_nas') }}
                            </a>
                        </div>
                        <div class="col-6 mb-3">
                            <a class="btn btn-sm btn-success d-block" href="#"
                                @click="doAction('enableCollection',true)">
                                <i class="fa fa-check"></i>
                                تشغيل المحددين
                            </a>
                        </div>
                        <div class="col-6 mb-3">
                            <a class="btn btn-sm btn-danger d-block" href="#"
                                @click="doAction('disableCollection',true)">
                                <i class="fa fa-check"></i>
                                ايقاف المحددين
                            </a>
                        </div>
                    </div>

                    <div class="row px-4" x-show="showFilters == true">
                        <div class="col-12 mb-3">
                            <a class="btn btn-sm btn-primary d-block" href="#"
                                wire:click="$dispatch('editViewColumns')" data-bs-dismiss="modal">
                                <i class="fa fa-exchange"></i>
                                اظهار وترتيب الاعمدة
                            </a>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="type" class="form-label">
                                    اختر سيرفر
                                </label>
                                <div>
                                    <select class="form-select" wire:model.live="selectedNas"
                                        x-on:change="closeModal">
                                        @foreach ($nas as $index => $nas)
                                            <option value="{{ $nas['serial'] }}">
                                                {{ $nas['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <label>
                                    الفيلتر
                                </label>
                                <div>
                                    <select class="form-select" wire:model.live="filterUsed"
                                        x-on:change="closeModal">
                                        @foreach ($filters as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}
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
                                        class="form-select form-control-sm" wire:model.live="perPage"
                                        x-on:change="closeModal">
                                        @foreach ($menuItems as $item)
                                            <option value="{{ $item }}">
                                                {{ $item }}
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

                </div>

            </div>
        </div>
    </div>
    <!-- /.modal -->
</div>
