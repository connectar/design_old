<div class="box box-bordered border-danger m-0 no-padding">
    <div class="box-header with-border py-3">
        <h4 class="box-title">
            {{ __('site.user_index.changeOffer.title') }}
            <span class="badge text-primary px-2 fs-16">
                {{ $userName }}
            </span>
        </h4>
    </div>
    <div class="box-body no-padding">
        <div class="collectionTable">
            @if ($step == 0)
                <div class="px-4 mt-3">
                    <div class="alert text-center text-bold">
                        <h4 class="text-bold">
                            <i class="icon fa fa-warning"></i>
                            {{ __('site.user_index.changeOffer.alert_title') }}
                        </h4>
                        <div>
                            {{ $processContent }}
                        </div>
                    </div>
                </div>
            @elseif($step == 1)
                @if (count($offers))
                    <div class="d-none d-md-block">
                        <table class="table table-striped text-center no-padding"
                            aria-describedby="dataTableId_info">
                            <x-table-thead :columns="__('datatable.admin_offer_box')" />
                            <tbody>
                                @foreach ($offers as $model)
                                    <tr>
                                        <td>{{ $model->name }}</td>
                                        <td class="no-padding">
                                            <span class="badge badge-success badge-pill">
                                                {{ $model->render()->quta() }}
                                            </span>
                                        </td>
                                        <td class="no-padding">
                                            <span class="badge badge-warning badge-pill">
                                                {{ $model->render()->price() }}
                                            </span>
                                        </td>
                                        <td class="no-padding">
                                            <span class="badge badge-danger badge-pill">
                                                {{ $model->render()->duration() }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="#"
                                                class="waves-effect waves-light btn btn-sm btn-info text-bold"
                                                wire:click="goTofinalStep('{{ $model->id }}')">
                                                <i class="fa fa-edit"></i>
                                                {{ __('site.user_index.changeOffer.select_button') }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-block d-md-none px-2">
                        <div class="row">
                            @foreach ($offers as $model)
                                <div class="col-12">
                                    <div class="box box-bordered border-dark">
                                        <div class="box-body py-2">
                                            <div class="text-center mb-1">
                                                <span class="badge badge-white">
                                                    {{ $model->name }}
                                                </span>
                                            </div>
                                            <div class="text-center">
                                                <span
                                                    class="badge badge-dark badge-pill text-success">
                                                    الكوتة : {{ $model->render()->quta() }}
                                                </span>
                                                <span
                                                    class="badge badge-dark badge-pill text-primary">
                                                    السعر : {{ $model->render()->price() }}
                                                </span>
                                                <span class="badge badge-dark badge-pill">
                                                    المدة :
                                                    {{ $model->render()->duration() }}
                                                </span>
                                            </div>
                                            <div class="my-1">
                                                <a href="#"
                                                    class="btn btn-sm btn-info text-bold pull-right"
                                                    wire:click="goTofinalStep('{{ $model->id }}')">
                                                    <i class="fa fa-edit"></i>
                                                    {{ __('site.user_index.changeOffer.select_button') }}
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
                            <h4 class="text-bold text-primary">
                                <i class="icon fa fa-warning"></i>
                                {{ __('site.user_index.changeOffer.alert_title') }}
                            </h4>
                            <div class="text-center">
                                <x-datatable.empty-records :text="__('site.user_index.changeOffer.empty_offers')" />
                            </div>
                        </div>
                    </div>
                @endif
            @elseif($step == 2)
                @include('backend.admins.users.includes.change_offer.step1')
            @elseif ($step == 3)
                @include('backend.admins.users.includes.change_offer.step2')
            @elseif ($step == 5)
                <div class="px-4 mt-4">
                    <div class="alert text-center text-bold">
                        <h4 class="text-bold text-primary h4">
                            <i class="icon fa fa-warning"></i>
                            <span class="text-danger">
                                {{ $errorMessage ?? 0 }}
                            </span>
                        </h4>
                    </div>
                </div>
            @endif
            @if ($step == 4)
                @include('backend.admins.users.includes.alert', [
                    'key' => 'changeOffer',
                ])
            @endif
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <div class="pull-right">
            <a href="#" data-bs-dismiss="modal" wire:click="buttonCancelClicked"
                class="btn btn-danger">
                {{ __('website.cancel') }}
            </a>
            @if ($step == 0)
                <button class="btn btn-success text-bold"
                    wire:click="continueChangeOffer('{{ $exeptOfferId }}')">
                    {{ __('site.user_index.changeOffer.continue') }}
                </button>
            @elseif($step == 2)
                <button type="button" wire:click="backToOffers" class="btn btn-dark">
                    <i class="fa spi fa-arrow-right"></i>
                    {{ __('site.user_index.changeOffer.back') }}
                </button>
                <a href="#" class="btn btn-success text-bold"
                    wire:click="prepareDataBeforeSave('3')">
                    {{ __('site.user_index.changeOffer.next') }}
                </a>
            @elseif ($step == 3)
                <button type="button" wire:click="$set('step','2')" class="btn btn-dark">
                    <i class="fa spi fa-arrow-right"></i>
                    {{ __('site.user_index.changeOffer.back') }}
                </button>
                <button type="button" class="btn btn-success" x-on:click="changeOffer()">
                    @lang('website.save')
                </button>
            @endif
        </div>
    </div>
</div>
