<x-datatable :paginated-data="$paginatedData">

    <x-slot name="navBar">
        <div class="col-sm-12 col-md-6">
            <a href="{{ route('admins.charging.create') }}" class="btn btn-success btn-md ml-5 fw-bold">
                <i class="fa spi fa-plus px-2"></i>
                {{ __('datatable.add_new_card_groups') }}
            </a>
            <a href="{{ route('admins.card-import.index','charge') }}" class="btn btn-primary btn-md ml-5 fw-bold">
                <i class="fa spi fa-upload px-2"></i>
                {{ __('datatable.upload_new_user') }}
            </a>
        </div>
        <div class="col-sm-12 col-md-6">
            {{--
            <x-datatable.table-search /> --}}
        </div>
        <x-datatable.filters :filters="$filters" :nas="$nas">

        </x-datatable.filters>
    </x-slot>

    <x-slot name="thead">
        <x-table-thead :columns="__('datatable.cards_charging_for_users')">
            <th>
                <span class="ps-5">#</span>
                <span style="padding-right: 5px;">
                    {{__('datatable.admin_cards_groups_index_key')}}
                </span>
            </th>
        </x-table-thead>
    </x-slot>

    <x-slot name="tbody">
        @if ($paginatedData && count($paginatedData) > 0)
        @foreach ($paginatedData as $index => $model)
        <tr class="fw-bold bs-3">
            <td class="py-2">
                @include('backend.admins.cards_charging.optional_box')
            </td>
            <td class="no-padding">
                <span class="badge badge-danger">
                    {{ $model->count }}
                </span>
            </td>
            <td class="no-padding">
                <span class="badge badge-info">
                    {{ $model->cards_count }}
                </span>
            </td>
            <td class="no-padding">
                <span class="badge badge-warning badge-dark">
                    {{ $model->count - $model->cards_count }}
                </span>
            </td>
            <td class="no-padding">
                <span class="badge badge-dark">
                    {{ $model->count * $model->price }}
                </span>
            </td>
            <td class="no-padding">
                <span class="badge badge-success fw-bold">
                    {{ $model->admin_fullname ?? __('site.charging_with_admin') }}
                </span>
            </td>
            <td class="no-padding">
                <a href="{{ route('admins.nas.edit', $model->nas_id) }}">
                    <span class="badge badge-primary fw-bold">
                        {{ $model->nas_name }}
                    </span>
                </a>
            </td>
        </tr>
        @endforeach
        @else
        <x-datatable.empty-records />
        @endif
    </x-slot>
</x-datatable>
