<div>
    <button wire:click="openStoreModal" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('site.general_add')}}</button>

    @if (session()->has('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger mt-2">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered mt-3 text-center">
        <thead>
        <tr class="text-center">
            <th class="text-center">{{__('site.general_from')}}</th>
            <th class="text-center">{{__('site.general_to')}}</th>
            <th class="text-center">{{__('site.general_price')}}</th>
            <th class="text-center">{{__('site.general_actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($converters as $converter)
            <tr class="text-center">
                <td class="text-center">{{ __('site.currency')[$converter->from] }}</td>
                <td class="text-center">{{ __('site.currency')[$converter->to] }}</td>
                <td class="text-center">{{ $converter->price }}</td>
                <td class="text-center">
                    <button wire:click="openEditModal({{ $converter->id }})" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i> {{__('site.general_update')}}</button>
                    <button wire:click="openDeleteModal({{ $converter->id }})" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> {{__('site.general_delete')}}</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Store Modal -->
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
                                <label for="from">{{__('site.general_from')}}</label>
                                <select wire:model="from" id="from" class="form-control">
                                    <option value="">{{__('site.general_select_currency')}}</option>
                                    @foreach(__('site.currency') as $code => $name)
                                        <option value="{{ $code }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('from') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="to">{{__('site.general_to')}}</label>
                                <select wire:model="to" id="to" class="form-control">
                                    <option value="">{{__('site.general_select_currency')}}</option>
                                    @foreach(__('site.currency') as $code => $name)
                                        <option value="{{ $code }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('to') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="price">{{__('site.general_price')}}</label>
                                <input type="text" wire:model="price" id="price" class="form-control">
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

<!-- Edit Modal -->
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
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">{{__('site.general_close')}}</button>
                            <button type="submit" class="btn btn-primary">{{__('site.general_save')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endif

<!-- Delete Modal -->
    @if($isDeleteOpen)
        <div class="modal fade show d-block" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('site.general_delete')}}</h5>
                        <button type="button" class="close" wire:click="closeModal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{__('site.general_validation_delete_confirm')}}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">{{__('site.general_close')}}</button>
                        <button type="button" class="btn btn-danger" wire:click="destroy">{{__('site.general_delete')}}</button>
                    </div>
                </div>
            </div>
        </div>

    @endif
</div>
