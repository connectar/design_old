<x-datatable :paginated-data="$paginatedData">


    <x-slot name="thead">
        <th wire:click="orderBy('admin_fullname')">
            <span class="badge">
                <span class="ps-6">#</span>
                <span style="padding-right: 20px">
                    مدير النظام المحصل
                </span>
            </span>
        </th>
        @foreach (trans('datatable.admin_transactions_outside_egypt') as $column => $value)
        <th class="text-center" wire:click="orderBy('{{ $column }}')">
            <span class="badge">
                {{ $value }}
            </span>
        </th>
        @endforeach
    </x-slot>

<x-slot name="tbody">
    @forelse ($paginatedData as $index => $model)
        <tr class="fw-bold">
            <td class="w-auto">
                <span class="badge badge-dark">
                    @if (($page ?? 1) != 1)
                        {{ $loop->index + 1 + $perPage * (($page ?? 1) - 1) }}
                    @else
                        {{ $loop->index + 1 }}
                    @endif
                </span>
                <span class="px-2 badge badge-success">
                    {{ $model->admin_fullname ?? '-'}}
                </span>
            </td>

            <td class="no-padding">
                <span class="badge badge-pill badge-info">
                    {{ $model->price ?? '-' }}
                </span>
            </td>

            <td class="no-padding">
                @if ($model->is_paid)
                    <span class="badge badge-success">
                        تم الدفع
                    </span>
                @else
                    <span class="badge badge-danger">
                        لم يتم الدفع
                    </span>
                @endif
            </td>
            <td class="no-padding">
                {{ $model->created_at ?? '-'}}
            </td>

        </tr>
        @empty
        <x-datatable.empty-records />
    @endforelse
</x-slot>
</x-datatable>
