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
            <div class="collectionTable">
                @if ($step == 'show_all')
                @isset($user->quta_info)
                <div class="col-12 mb-1">
                    <a href="#" class="btn btn-success btn-sm pb-2" wire:click="addNewQuta">
                        <i class="fa fa-plus"></i>
                        {{ __('site.user_index.show_and_add_quta.add_new') }}
                    </a>
                </div>
                <div class="col-12">
                    <div class="table-responsive d-none d-md-block">
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
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-block d-md-none px-2">
                        <div class="row">
                            @foreach ($user->quta_info as $index => $model)
                            <div class="col-12">
                                <div class="box box-bordered border-dark">
                                    <div class="box-body py-2">
                                        <div class="text-center mb-1">
                                            <span class="badge badge-dark badge-pill" dir="auto">
                                                اسم الباقة : <span dir="auto">{{ $model['quta_name'] ?? '' }}</span>
                                            </span>
                                        </div>
                                        <div class="text-center" dir="auto">
                                            <span class="badge badge-dark badge-pill text-success mb-2">
                                                الحالة : @isset($model['status'])
                                                {{ __('networks.quta.statuses.' . $model['status']) }}
                                                @endisset
                                            </span>
                                            <span class="badge badge-dark badge-pill text-primary" dir="auto">
                                                الفترة : {{ now()->parse($model['started_at'])->toDateString() ?? '' }}
                                            </span>-
                                            <span class="badge badge-dark badge-pill mx-1">
                                                @isset($model['expired_at'])
                                                <span dir="auto">
                                                    {{ now()->parse($model['expired_at'])->toDateString() }}
                                                </span>
                                                @else
                                                <span class="text-primary">
                                                    تنتهى بانتهاء التجديد القادم
                                                </span>
                                                @endisset
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
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
                @elseif($step == 'add_new')
                @if ($qutas && count($qutas))
                <div class="table-responsive d-none d-md-block">
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
                                    <a href="#" class="waves-effect waves-light btn btn-sm btn-info text-bold"
                                        wire:click="selectQuta({{ $model->id }},'{{ $model->renderQuta() }}')">
                                        <i class="fa fa-plus"></i>
                                        {{ __('site.user_index.add_quta.select_button') }}
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-block d-md-none px-2">
                    <div class="row">
                        @foreach ($qutas as $model)
                        <div class="col-12">
                            <div class="box box-bordered border-dark">
                                <div class="box-body py-2">
                                    <div class="text-center mb-1">
                                        <span class="badge badge-dark badge-pill text-primary" dir="auto">
                                            الباقة : <span dir="auto"> {{ $model->renderQuta() }}</span>
                                        </span>
                                        <span class="badge badge-dark badge-pill" dir="auto">
                                            السعر : <span dir="auto">{{ $model->price }}</span>
                                        </span>
                                    </div>
                                    <div class="text-center" dir="auto">
                                        <span class="badge badge-dark badge-pill text-success mb-2">
                                            الحالة : @isset($model['status'])
                                            {{ __('networks.quta.statuses.' . $model->status) }}
                                            @endisset
                                        </span>
                                    </div>
                                    <div class="my-1">
                                        <a href="#"
                                            class="waves-effect waves-light btn btn-sm btn-info text-bold pull-right"
                                            wire:click="selectQuta({{ $model->id }},'{{ $model->renderQuta() }}')">
                                            <i class="fa fa-plus"></i>
                                            {{ __('site.user_index.add_quta.select_button') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <div class="px-4 mt-3">
                    <div class="alert text-center text-bold">
                        <div class="text-center">
                            <x-datatable.empty-records :text="__('site.user_panel.add_quta.errors.empty')" />
                            <a class="btn btn-success btn-md" href="{{ route('admins.quta.create') }}">
                                {{ __('site.user_panel.add_quta_title') }}
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                @elseif($step == 'confirmSaving')
                <div class="px-4 mt-4">
                    <div class="alert text-center text-bold mb-0">
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
                <div class="col-12 d-flex justify-content-center mx-auto">
                    <div class="form-group row">
                        <h5 class="col-sm-2  text-primary " style="display:contents;">
                            {{ __('adding.user_option.change_offer_payment_title') }}
                        </h5>
                        <div class="col-sm-10 py-3 px-4">
                            <div>
                                <input name="invoiceStatus" wire:model="invoiceStatus"
                                    type="radio" id="radio_32"
                                    class="with-gap radio-col-success" value="1">
                                <label for="radio_32">
                                    {{ __('adding.user_option.change_offer_payment.1') }}
                                </label>
                                <input name="invoiceStatus" wire:model="invoiceStatus"
                                    type="radio" id="radio_36"
                                    class="with-gap radio-col-danger" value="0">
                                <label for="radio_36">
                                    {{ __('adding.user_option.change_offer_payment.0') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    @error('expired_at')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
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
                @elseif($step == 'error')
                <div class="px-4 mt-4">
                    <div class="alert text-center text-bold">
                        <h4 class="text-bold text-primary h4">
                            <i class="icon fa fa-warning"></i>
                            <span class="text-danger">
                                @if ($errorKey == 'distributor')
                                {{ $errorMessage }}
                                @else
                                {{ __('site.user_index.show_and_add_quta.' . $errorKey) }}
                                @endif
                            </span>
                        </h4>
                    </div>
                </div>
                @elseif ($step == 'print')
                @include('backend.admins.users.includes.alert',[
                'key' => 'renew'
                ])

                @endif
            </div>
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
