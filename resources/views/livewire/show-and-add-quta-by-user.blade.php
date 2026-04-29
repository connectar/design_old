<form wire:submit="submitForm">
    <div class="box border-success m-0">
        <div class="box-header with-border py-1">
            <h4 class="box-title">
                {{ __('site.user_index.show_and_add_quta.title') }}
                <span class="badge text-primary px-2 fs-16">
                    {{ $user->fullname ?? '' }}
                </span>
            </h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            @if ($step == 'show_all')
            @isset($user->quta_info)
            <div class="col-12 mb-1">
                <a href="#" class="btn btn-success btn-sm pb-2" wire:click="addNewQuta">
                    <i class="fa fa-plus"></i>
                    {{ __('site.user_index.show_and_add_quta.add_new') }}
                </a>
            </div>
            <div class="col-12">
                <table class="table table-striped table-bordered">
                    <thead class="text-center">
                        <th class="text-center">اسم الكوتة</th>
                        <th class="text-center"> الحالة</th>
                        <th class="text-center">تاريخ البدء</th>
                        <th class="text-center">تاريخ الانتهاء</th>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($user->quta_info as $index => $model)
                        <tr class="py-1">
                            <td dir="ltr">
                                <span class="badge badge-info badge-pill">
                                    {{ $model['quta_name'] ?? '' }}
                                </span>
                            </td>
                            <td>
                                <span>
                                    @isset($model['status'])
                                    {{ __('networks.quta.statuses.' . $model['status']) }}
                                    @endisset
                                </span>
                            </td>
                            <td>
                                <span class="">
                                    {{ now()->parse($model['started_at'])->toDateString() ?? '' }}
                                </span>
                            </td>
                            <td>
                                @isset($model['expired_at'])
                                <span class="">
                                    {{ now()->parse($model['expired_at'])->toDateString() }}
                                </span>
                                @else
                                <span class="text-primary">
                                    تنتهى بانتهاء التجديد القادم
                                </span>
                                @endisset
                            </td>

                            {{-- <td>
                                <a href="#" class="btn btn-danger btn-sm pb-2"
                                    wire:click="deleteExistingMac('{{ $mac }}')">
                                    <i class="fa fa-trash-o"></i>
                                    {{ __('site.user_index.ShowAndEditMacs.delete') }}
                                </a>
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- /.tab-pane -->

                <!-- /.tab-content -->
            </div>
            @else
            <div class="text-center">
                <span class="text-danger px-1">
                    {{ __('site.user_index.show_and_add_quta.no_quta') }}
                </span>
                <a href="#" class="btn btn-success btn-sm pb-2" wire:click="addNewQuta">
                    <i class="fa fa-plus"></i>
                    {{ __('site.user_index.show_and_add_quta.add_new') }}
                </a>
            </div>
            @endisset
            @elseif($step =='add_new')
            @if ($qutas && count($qutas))
            <table class="table table-striped text-center">
                <x-table-thead :columns="__('datatable.admin_quta_modal')" />
                <tbody>
                    @foreach ($qutas as $model)
                    <tr class="fw-bold">
                        <td dir="auto">
                            <span class="badge badge-success fs-16">
                                {{ $model->renderQuta() }}
                            </span>
                        </td>
                        <td>
                            <span class=" badge
                                    badge-danger fs-16">
                                {{ $model->price }}
                            </span>
                        </td>
                        <td>
                            <span class="text-lighter">
                                {{ __('networks.quta.statuses.' . $model->status) }}
                            </span>
                        </td>
                        <td>
                            @if ($user->account >= $model->price)
                            <a href="#" class="waves-effect waves-light btn btn-sm btn-info text-bold"
                                wire:click="selectQuta({{ $model->id }},'{{ $model->renderQuta() }}')">
                                <i class="fa fa-plus"></i>
                                {{ __('site.user_index.add_quta.select_button') }}
                            </a>
                            @else
                            <span class="text-primary">
                                {{ __('site.user_panel.add_quta.account_less_price') }}
                            </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="px-4 mt-3">
                <div class="alert text-center text-bold">
                    <div class="text-center">
                        <x-datatable.empty-records :text="__('site.user_panel.add_quta.errors.empty')" />
                        {{-- <a class="btn btn-success btn-md" href="{{ route('admins.quta.create') }}">
                            {{ __('site.user_panel.add_quta_title') }}
                        </a> --}}
                    </div>
                </div>
            </div>
            @endif
            @elseif($step=='confirmSaving')
            <div class="px-4 mt-4">
                <div class="alert text-center text-bold">
                    <h4 class="text-bold text-primary h4">
                        <i class="icon fa fa-warning"></i>
                        <span class="text-white">
                            {{ __('site.user_index.show_and_add_quta.confirm_alert') }}
                        </span>
                        <span dir="ltr">{{ $qutaName }}</span>
                        <span class="text-white">
                            {{ __('site.user_index.show_and_add_quta.confirm_alert2') }}
                        </span>
                    </h4>
                </div>
            </div>
            <div class="col-12 px-1 text-center">
                <div>
                    <a href="#" class="btn btn-dark btn-sm pb-2 text-primary" wire:click="$set('step','add_new')">
                        <i class="fa spi fa-arrow-right"></i>
                        رجوع لكل الباقات
                    </a>
                    <a href="#" class="btn btn-success btn-sm pb-2 mx-1" wire:click="save">
                        {{ __('website.ok_save') }}
                    </a>

                </div>
            </div>
            @elseif($step=='error')
            <div class="px-4 mt-4">
                <div class="alert text-center text-bold">
                    <h4 class="text-bold text-primary h4">
                        <i class="icon fa fa-warning"></i>
                        <span class="text-danger">
                            {{ __('site.user_index.show_and_add_quta.' . $errorKey) }}
                        </span>
                    </h4>
                </div>
            </div>
            @endif
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="pull-right">
                @if ($step != 'show_all')
                <a href="#" class="btn btn-dark text-primary mx-1" wire:click="$set('step','show_all')">
                    <i class="fa spi fa-arrow-right"></i>
                    باقات العميل
                </a>
                @endif
                <a href="#" data-bs-dismiss="modal" class="btn btn-danger" wire:click="buttonCancelClicked">
                    {{ __('website.cancel') }}
                </a>
            </div>
        </div>
    </div>
</form>
