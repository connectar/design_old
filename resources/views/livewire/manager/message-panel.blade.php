@push('styles')
    <style>
        .btn-default:active,
        .btn-default:focus{
            background: none !important;
            border-color: rgba(255, 255, 255, 0.12) !important;
        }
    </style>
@endpush
<div>
    <div class="d-flex mobile-display-block justify-content-around">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        @if($item_id)
                           {{__('notification.message_type.edit_notification')}}
                        @else
                            {{__('notification.message_type.add_notification')}}
                        @endif
                    </h4>
                    <ul class="box-controls pull-right">

                        <li><a class="box-btn-slide" href="#"></a></li>
                        <li><a class="box-btn-fullscreen" href="#"></a></li>
                    </ul>
                </div>
                <div class="box-body">
                    <div class="row">
                        <input type="hidden" name="id" value="{{$item_id}}">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa  fa-paper-plane"></i>
                                    </div>
                                    <select class="form-select show-tick"
                                            wire:model="type" @if($item_id) disabled="disabled" @endif>
                                        <option value="" selected="selected">Select</option>
                                        @foreach($message_type as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control" placeholder="{{__('notification.message_type.title_notification')}}" wire:model="subject">
                                @error('subject')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <textarea placeholder="{{__('notification.message_type.content_notification')}}" rows="4" class="form-control bg-dark" wire:model="message"></textarea>
                                @error('message')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-end">
                                @if($item_id)
                                    <button type="button" wire:click="update"
                                            wire:loading.attr="disabled" wire:target="update"
                                            class="btn btn-primary mt-3">{{__('notification.message_type.save')}}</button>
                                @else
                                    <button type="button" wire:click="create"
                                            wire:loading.attr="disabled" wire:target="create"
                                            class="btn btn-success mt-3">{{__('notification.message_type.create')}}</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-datatable :paginated-data="$paginatedData">
        <x-slot name="thead">
            @foreach (trans('datatable.message_panel') as $column => $value)
                <th class="text-center">
                    <span class="badge">
                        {{ $value }}
                    </span>
                </th>
            @endforeach
        </x-slot>

        <x-slot name="tbody">
            @forelse ($paginatedData as $index => $model)
                <tr class="fw-bold">
                    <td>
                        <span class="badge badge-dark">
                            @if (($page ?? 1) != 1)
                                {{ $loop->index + 1 + $perPage * (($page ?? 1) - 1) }}
                            @else
                                {{ $loop->index + 1 }}
                            @endif
                        </span>
                        <span class="dropdown-toggle px-2 badge badge-info" data-bs-toggle="dropdown">
                            {{$message_type[$model->type]}}
                        </span>
                        <div class="dropdown-menu dropdown-menu-end fw-bold">
                           @if($model->type != \App\ENUMS\MessagePanelEnum::NOTIFICATION)
                                <a class="dropdown-item py-2 fw-bold" wire:click="confirmEdit({{ $model->id }})">
                                    <i class="fa fa-edit text-success"></i>
                                    {{__('notification.message_type.edit')}}
                                </a>
                            @endif
                                <a class="dropdown-item py-2 fw-bold" wire:click="confirmDelete({{ $model->id }})">
                                <i class="fa fa-trash-o text-danger"></i>
                                    {{__('notification.message_type.delete')}}
                            </a>
                        </div>
                    </td>
                    <td>
                        {{$model->subject}}
                    </td>
                    <td>
                        {{$model->created_by}}
                    </td>
                    <td>
                        {{ date('Y-m-d',strtotime($model->updated_at)) ?? '-' }}
                    </td>
                </tr>
            @empty
                <x-datatable.empty-records />
            @endforelse
        </x-slot>
    </x-datatable>
    <div class="modal" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{__('notification.message_type.delete')}}</h4>
                </div>
                <div class="modal-body">
                    {{__('notification.message_type.are_you_sure_delete')}}
                </div>
                <div class="modal-footer">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('notification.message_type.cancel')}}</button>
                        <button type="button" wire:click="delete" class="btn btn-danger">{{__('notification.message_type.delete')}}</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}">
    </script>
    <script>
        Livewire.on('openDeleteModal', () => {
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        });
        Livewire.on('openEditModal', () => {
            const deleteModal = new bootstrap.Modal(document.getElementById('editModal'));
            deleteModal.show();
        });
        Livewire.on('refreshTable', () => {
            location.reload(); // Reloads the entire page
        });
    </script>
@endpush

