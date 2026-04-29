@if ($testing)
    <div class="p-3 text-center">
        <h1 class="text-primary fs-30">يتم اختبارها حاليا ستكون متاحة قريبا </h1>
        <a href="#" data-bs-dismiss="modal" wire:click="buttonCancelClicked" class="btn btn-danger">
            {{ __('website.close') }}
        </a>
    </div>
    @php
        return;
    @endphp
@endif
<div class="box box-bordered border-danger m-0 no-padding">
    <div class="box-header with-border py-3">
        <h4 class="box-title">
            {{ __('site.user_panel.add_quta.title') }}
            <span class="badge text-primary px-2 fs-16">
                {{ $user->fullname ?? '' }}
            </span>
        </h4>
    </div>
    <div class="box-body no-padding">
        @if ($step == 1)
            @if (count($models))
                <div class="table-responsive">
                    <table class="table table-striped text-center">
                        <x-table-thead :columns="__('datatable.admin_quta_modal')" />
                        <tbody>
                            @foreach ($models as $model)
                                <tr class="fw-bold">
                                    <td dir="auto">
                                        <span class="badge badge-success fs-16">
                                            {{ $model->renderQuta() }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class=" badge badge-danger fs-16">
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
                                            <button href="#"
                                                class="waves-effect waves-light btn btn-sm btn-info text-bold"
                                                wire:click="selectQuta({{ $model->id }})">
                                                <i class="fa fa-money"></i>
                                                {{ __('site.user_panel.add_quta.select_button') }}
                                            </button>
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
                </div>
            @else
                <div class="px-4 mt-3">
                    <div class="alert text-center text-bold">
                        <div class="text-center">
                            <x-datatable.empty-records
                                :text="__('site.user_panel.add_quta.errors.empty')" />
                        </div>
                    </div>
                </div>
            @endif
        @else
            <div class="px-4 mt-4">
                <div class="alert text-center text-bold">
                    <h4 class="text-bold text-primary h4">
                        <i class="icon fa fa-warning"></i>
                        {{ __('site.user_panel.add_quta.alert_title_1') }}
                        <span class="text-white">
                            {{ __('site.user_panel.add_quta.alert_title_2') }}
                        </span>
                    </h4>
                </div>
            </div>
        @endif
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <div class="pull-right">
            <a href="#" data-bs-dismiss="modal" wire:click="buttonCancelClicked"
                class="btn btn-danger">
                {{ __('website.cancel') }}
            </a>
            @if ($step > 1)
                <button type="button" wire:click="$set('step','1')" class="btn btn-dark">
                    <i class="fa spi fa-arrow-right"></i>
                    {{ __('site.user_index.changeOffer.back') }}
                </button>
                <button wire:click="save" class="btn btn-success">
                    @lang('website.ok')
                </button>
            @endif
        </div>
    </div>
</div>

<!-- /.box -->
