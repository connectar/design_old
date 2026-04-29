<div>
    <x-datatable :paginated-data="$paginatedData">

        <x-slot name="thead">
            <x-table-thead :columns="__('new_trans.expenses.datatable.message_tracking_head')">

            </x-table-thead>
        </x-slot>

        <x-slot name="tbody">
            @forelse ($paginatedData as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->phone_number }}</td>
                    <td> {{ __('site.message_type')[$item->type] ?? 'غير محدد' }}</td>
                    @if ($item->price)
                        <td>{{ $item->price }}
                            {{ isset(__('site.currency')[$item->currency]) ? __('site.currency')[$item->currency] : '' }}
                        </td>
                    @else
                        <td>مجاني</td>
                    @endif
                    <td>
                        <i class='{{ \App\ENUMS\WhatsappTemplate::getWhatsappMessagesStatusIcon($item->status) }}'></i>
                    </td>
                    <td>{{ date('Y-m-d H:i:s', strtotime($item->created_at)) }}</td>
                </tr>
            @empty
                <x-datatable.empty-records />
            @endforelse
        </x-slot>
    </x-datatable>
</div>
