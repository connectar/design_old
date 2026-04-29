<div class="d-block d-md-none">
    <div class="px-2 py-0">
        <div class="serach_box_overlay">
            <input type="search" class="form-control form-control-md bg-lightest text-black"
                wire:model.live.debounce.500ms="search" placeholder="ابحث" dir="auto">
        </div>
        @foreach ($paginatedData as $index => $model)
            <div class="box box-bordered border-dark">
                <div class="box-header py-1 px-2">
                    @include('backend.includes.users_online_mobile_index_menu')
                </div>
                <div class="box-body py-1 px-2">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row">
                                <div>
                                    <span>اسم الدخول</span>
                                    <span class="badge text-primary" dir="auto">
                                        {{ $model->username }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div>
                                    <span>العرض</span>
                                    <span class="text-info" dir="auto">
                                        {{ $model->offer_name ?? '' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group row">
                                <label class="form-label">
                                    الاستهلاك
                                </label>
                                <div>
                                    <span class="badge badge-dark text-primary d-block"
                                        dir="auto">
                                        {{ $model->render()->total() }}
                                        <i class="fa fa-arrow-down"></i>
                                        <i class="fa fa-arrow-up"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row">
                                <label class="form-label">
                                    الوقت
                                </label>
                                <div>
                                    <span class="badge badge-dark text-primary d-block"
                                        dir="auto">
                                        {{ $model->render()->uptime() }}
                                        <i class="fa fa-clock-o"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group row">
                                <label class="form-label">
                                    ايبى ادريس
                                </label>
                                <div>
                                    <span class="badge badge-dark text-primary d-block"
                                        dir="auto">
                                        {{ $model->framedipaddress ?? '---' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row">
                                <label class="form-label">
                                    ماك ادريس
                                </label>
                                <div>
                                    <span class="badge badge-dark text-primary d-block"
                                        dir="auto">
                                        {{ $model->macaddress ?? '---' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group row">
                                <label class="form-label">
                                    الانتهاء
                                </label>
                                <div>
                                    <span class="badge badge-dark text-primary d-block"
                                        dir="auto">
                                        {{ $model->onlineRender()->expiredAt() ?? '---' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row">
                                <label class="form-label">
                                    المنطقة
                                </label>
                                <div>
                                    <span class="badge badge-dark text-primary d-block"
                                        dir="auto">
                                        {{ $model->city ?? '---' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="my-1 text-center">
                        <div class="dropup">
                            <span class="dropdown-toggle p-2 badge badge-primary"
                                data-bs-toggle="dropdown">
                                خيارات
                            </span>
                            <div class="dropdown-menu px-5" style="min-width: 16rem;">
                                <a class="dropdown-item py-2 fw-bold text-danger" href="#"
                                    x-on:click="removeFromActive('{{ $model->username }}','{{ $model->nas_ip_address }}','{{ $model->connection_type }}')">
                                    <i class="fa spi  fa-user-times"></i>
                                    {{ __('site.user_index.option.remove_from_active') }}
                                </a>
                                <a class="dropdown-item py-2 fw-bold"
                                    href="{{ route('admins.users.edit', $model->id) }}">
                                    <i class="fa spi fa-edit"></i>
                                    {{ __('site.user_index.option.edit') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-12 d-flex flex-row justify-content-center">
            {{ $paginatedData->onEachSide(1)->links('vendor.pagination.livewire.crypto_paginate') }}
        </div>
    </div>
    @include('backend.admins.users.includes.online.mobile_overlay')
</div>
