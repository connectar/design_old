<div>
    <button wire:click="openStoreModal" class="btn btn-primary"><i class="fa fa-plus"></i>{{__('site.general_add')}}</button>
@if (session()->has('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger mt-2">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered mt-3 text-center">
        <thead>
        <tr class="text-center">
            <th class="text-center">{{__('site.general_service')}}</th>
            <th class="text-center">{{__('site.general_status')}}</th>
            <th class="text-center">{{__('site.general_message_price')}}</th>
            <th class="text-center">{{__('site.general_currency')}}</th>
            <th class="text-center">{{__('site.general_update')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($items as $item)
            <tr class="text-center">
                <td class="text-center">{{__('site.message_type')[$item->type]}}</td>
                <td class="text-center">{{__('site.status_arr')[$item->status]}}</td>
                <td class="text-center">{{$item->price}}</td>
                <td class="text-center">{{__('site.currency')[$item->currency]}}</td>
                <td class="text-center">
                    <button wire:click="openEditModal({{ $item->id }})" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i> {{__('site.general_update')}} </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @if($isStoreOpen)
       <div class="modal fade show d-block" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{__('site.general_add')}}</h5>
                        </div>
                        <div class="modal-body">
                            <form wire:submit="store">
                                <div class="form-group">
                                    <label>{{__('site.general_service')}}</label>
                                    <select wire:model="type" class="form-control">
                                        <option value="">{{__('site.general_select_service')}}</option>
                                        @foreach(__('site.message_type') as $code => $name)
                                            <option value="{{ $code }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label>{{__('site.general_currency')}}</label>
                                    <select wire:model="currency" class="form-control">
                                        <option value="">{{__('site.general_select_currency')}}</option>
                                        @foreach(__('site.currency') as $code => $name)
                                            <option value="{{ $code }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('currency') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="price">{{__('site.general_message_price')}}</label>
                                    <input type="text" wire:model="price" class="form-control">
                                    @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <button type="button" class="btn btn-secondary" wire:click="closeModal">{{__('site.general_close')}}</button>
                                <button type="submit" class="btn btn-primary">{{__('site.general_save')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
     @endif
    @if($isEditOpen)
        <div class="modal fade show d-block" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('site.general_update')}}</h5>
                    </div>
                    <div class="modal-body">
                        <form wire:submit="update">
                            <div class="form-group">
                                <label for="price">{{__('site.general_price')}}</label>
                                <input type="text" wire:model="price" id="price" class="form-control">
                                @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label>{{__('site.general_currency')}}</label>
                                <select wire:model="currency" class="form-control">
                                    <option value="">{{__('site.general_select_currency')}}</option>
                                    @foreach(__('site.currency') as $code => $name)
                                        <option value="{{ $code }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('currency') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label>{{__('site.general_status')}}</label>
                                <select wire:model="status" class="form-control">
                                    <option value="">{{__('site.general_select_status')}}</option>
                                    @foreach(__('site.status_arr') as $code => $name)
                                        <option value="{{ $code }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">{{__('site.general_close')}}</button>
                            <button type="submit" class="btn btn-primary">{{__('site.general_save')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
