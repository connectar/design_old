<div class="box">
    <div class="box-header py-0">
        <h4 class="box-title py-2">
            {{ __('site.add_transaction.title') }}
        </h4>
    </div>
    <div class="box-body px-xs-0">
        <div class="box border-success">
            <!-- /.box-header -->
            <div class="box-body px-xs-0">
                @if ($step == 1)
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="fullname" class="col-form-label">
                                {{ __('site.add_transaction.transaction_id') }}
                            </label>
                            <div>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-barcode text-primary"></i>
                                    </div>
                                    <input class="form-control" type="text" wire:model="transaction_id"
                                        placeholder="مثال : 001200003412">
                                </div>
                            </div>
                        </div>
                        @error('transaction_id')
                        <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="fullname" class="col-form-label">
                                {{ __('site.add_transaction.phone') }}
                            </label>
                            <div>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone text-primary"></i>
                                    </div>
                                    <input class="form-control" type="text" wire:model="phone"
                                        placeholder="مثال : 01012212294">
                                </div>
                            </div>
                        </div>
                        @error('phone')
                        <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="fullname" class="col-form-label">
                                {{ __('site.add_transaction.total_price') }}
                            </label>
                            <div>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-money text-success"></i>
                                    </div>
                                    <input class="form-control" type="text" wire:model="price"
                                        placeholder="مثال : 100">
                                </div>
                            </div>
                        </div>
                        @error('price')
                        <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="fullname" class="col-form-label">
                                {{ __('site.add_transaction.type') }}
                            </label>
                            <div>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-info text-success"></i>
                                    </div>
                                    <select class="form-select" wire:model="transactionTypeSelected">
                                        @foreach ($transactionTypes as $value => $name)
                                        <option value="{{$value}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @error('transactionTypeSelected')
                        <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                @if($showAddPriceToOther)
                @foreach ($priceContent as $index=>$array)
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="fullname" class="col-form-label">
                                {{ __('site.add_transaction.billing_code_' . $index) }}
                            </label>
                            <div>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-credit-card-alt text-primary"></i>
                                    </div>
                                    <input class="form-control @if($index==0) bg-dark @endif" type="text"
                                        wire:model="priceContent.{{$index}}.billing_code" @if($index==0 ) disabled
                                        @endif>
                                </div>
                            </div>
                        </div>
                        @error("priceContent.{$index}.billing_code")
                        <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="fullname" class="col-form-label">
                                @if($index == 0)
                                {{ __('site.add_transaction.price_0') }}
                                @else
                                {{ __('site.add_transaction.price') }}
                                @endif
                            </label>
                            <div>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-money text-success"></i>
                                    </div>
                                    <input class="form-control" type="number" min="0"
                                        wire:model="priceContent.{{$index}}.price" placeholder="مثال : 100">
                                    @if($index > 0 )
                                    <div class="input-group-addon p-0">
                                        @if($index > 1)
                                        <a href="#" class="btn btn-danger btn-sm pb-2"
                                            wire:click="deletePrice({{$index}})">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                        @endif
                                        @if($loop->last)
                                        <a href="#" class="btn btn-success btn-sm pb-2" wire:click="addNewPrice">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @error("priceContent.{$index}.price")
                        <span class="error text-danger">{{ $message }}</span>
                        @enderror
                        @error('totalPrice')
                        <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                @endforeach

                @endif

                @elseif($step == 2)
                <table class="table">
                    <tr class="text-center">
                        <td>
                            <span>
                                {{__('site.add_transaction.transaction_id')}}
                                <span class="badge text-primary fs-18">
                                    {{$transaction_id ?? ''}}
                                </span>
                            </span>
                            <span>
                                {{__('site.add_transaction.total_price')}}
                                <span class="badge text-success fs-18">
                                    {{$price ?? 0}}
                                </span>
                            </span>
                        </td>
                    </tr>
                    @if($transactionTypeSelected==2)
                    @foreach ($priceContent as $index=>$array)
                    @if($index==0)
                    <tr class="text-center">
                        <td colspan="3">
                            {{__('site.add_transaction.account_self')}}
                            <span class="badge text-success fs-18">
                                {{$array['price']}}
                            </span>
                        </td>
                    </tr>
                    @else
                    <tr class="text-center">
                        <td colspan="3">
                            <div class="mb-1 text-danger">
                                {{__('site.add_transaction.account_other') . $index}}
                            </div>
                            <span>
                                {{__('site.add_transaction.billing_code')}}
                                <span class="badge text-primary fs-18">
                                    {{$array['billing_code']}}
                                </span>
                            </span>
                            <span class="mx-2">
                                {{__('site.add_transaction.price')}}
                                <span class="badge text-success fs-18">
                                    {{$array['price']}}
                                </span>
                            </span>
                            <span>
                                {{__('site.add_transaction.admin_name')}}
                                <span class="badge text-warning">
                                    {{$array['admin_name']}}
                                </span>
                            </span>
                        </td>
                    </tr>

                    @endif
                    @endforeach
                    @endif
                </table>

                @elseif($step == 3)
                <div class="px-4 mt-4">
                    <div class="alert text-center text-bold">
                        <span>
                            <i class="fa fa-check fs-40 text-success"></i>
                        </span>
                        <h4 class="text-bold">
                            <span class="text-success">
                                {{ __('site.add_transaction.success') }}
                            </span>
                        </h4>
                        <span class="text-primary">

                        </span>
                        <div class="mt-4">
                            <a href="#" wire:click="$emitUp('showTransactions')" class="btn btn-sm btn-danger">
                                {{ __('site.add_transaction.back_to_all') }}
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    @if($step < 3) <div class="box-footer p-2">
        <div class="pull-right">
            @if ($step == 1)
            <button type="button" class="btn btn-success" wire:click="goNext" wire:loading.attr="disabled">
                @lang('website.next')
            </button>
            @else
            <a class="btn btn-dark" wire:click.prevent="$set('step',1)">
                {{ __('website.back') }}
            </a>
            <button type="button" class="btn btn-success" wire:click="save" wire:loading.attr="disabled">
                @lang('website.save')
            </button>
            @endif
        </div>
</div>
@endif
</div>

<!-- /.box -->
