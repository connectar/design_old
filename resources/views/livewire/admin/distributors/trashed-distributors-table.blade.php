<div>



<div>

<x-datatable :paginated-data=null>

    <x-slot name="navBar">
        <div class="box-header with-border py-3" style="width:100%;display:flex;justify-content:space-between;align-items:start;">
			<div>
				<h4 class="box-title">
					{{ trans('new_trans.distributors.trashed.index') }}
				</h4>
			</div>

		</div>
        <div class="col-6">

        </div>

    </x-slot>

    <x-slot name="thead">
        <x-table-thead :columns="__('new_trans.distributors.trashed.datatable.thead')">

        </x-table-thead>
    </x-slot>

    <x-slot name="tbody">
            @forelse ($paginatedDistributors as $index => $model)
                <tr>
                    <td class="">
                        <div class="dropdown ">
                            <div class="clearfix pull-left">
                                <span class="badge badge-dark b-1 border-warning">
                                    @if (($page ?? 1) != 1)
                                        {{ $loop->index + 1 + $perPage * (($page ?? 1) - 1) }}
                                    @else
                                        {{ $loop->index + 1 }}
                                    @endif
                                </span>
                                <span class="dropdown-toggle badge badge-danger badge-pill " data-bs-toggle="dropdown">
                                    <span dir="auto" >
                                        {{ $model->fullname }}
                                    </span>
                                </span>

                                <div class="dropdown-menu dropdown-menu-end fw-bold "  aria-labelledby="dropdown" >
                                  <a class="dropdown-item py-4 fw-bold" wire:loading.attr="disabled"  wire:click="restoreDistributor({{$model->id}})" >
                                      <i class="fa fa-undo text-success"></i>
                                      {{ __('new_trans.distributors.trashed.restore')}}
                                  </a>
                                  <a class="dropdown-item py-4 fw-bold" wire:loading.attr="disabled" wire:click.prevent="showDeletedBox({{ $model->id }})" >
                                      <i class="fa fa-trash text-danger"></i>
                                      {{ __('new_trans.distributors.trashed.force_delete')}}
                                  </a>
                                </div>
                            </div>
                        </div>
                    </td>

                    <td>
                      {{ $model->phone }}
                    </td>
                    <td >
                      <span class="badge badge-info">
                        {{ $model->users_count }}
                      </span>
                    </td>
                    <td>
                      <span class="badge badge-success">
                        {{ $model->account }}
                    </td>
          					<td>
          						{{ $model->deleted_at }}
          					</td>
                </tr>
                @empty
                <x-datatable.empty-records />
            @endforelse




    </x-slot>
</x-datatable>


@if($perPage < $distributors_count)

<div class="box pt-4">
    {{ $paginatedDistributors->links('vendor.pagination.crypto_paginate')  }}
</div>
@endif




</div>

</div>
