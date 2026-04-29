<x-datatable :paginated-data="$paginatedData">

    <x-slot name="navBar">
        <x-datatable.add-new :route="route('admins.charging.create')" :title="__('datatable.add_new_card_groups')" />

        <div class="col-sm-12 col-md-6">
            <x-datatable.table-search />
        </div>
        @isset($filters)
        <x-datatable.filters :filters="$filters" :nas="$nas">
            {{-- add more filters here --}}
        </x-datatable.filters>
        @endisset
    </x-slot>

    <x-slot name="thead">
        <x-table-thead :columns="__('datatable.admin_cards_for_charging')"
            :title="__('datatable.admin_cards_for_charging_key')" :action="false" />
    </x-slot>

    <x-slot name="tbody">

        @if ($paginatedData && count($paginatedData) > 0)
        @foreach ($paginatedData as $index => $model)
        <tr class="fw-bold bs-3">
            <td class="py-2">
                @include('backend.optionalBox.cards-for-charging')
            </td>
            <td class="no-padding">
                <span class="badge badge-danger badge-pill">
                    {{ $model->price }}
                </span>
            </td>
            <td class="no-padding">
                <span class="badge  badge-info badge-pill">
                    {{ $model->admin_fullname ?? __('site.charging_with_admin') }}
                </span>
            </td>

            <td class="no-padding">
                <span class="badge badge-warning badge-pill">
                    {{ $model->user_fullname ?? '---' }}
                </span>
            </td>
            <td class="no-padding">
                <span class="badge badge-dark badge-pill">
                    {{ $model->charging_at ?? '---' }}
                </span>
            </td>

            <td class="no-padding">
                <a href="{{ route('admins.nas.edit', $model->nas_id) }}">
                    <span class="badge badge-primary badge-pill fw-bold">
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
