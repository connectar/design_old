<x-datatable :paginated-data="$paginatedData">

    <x-slot name="navBar">
        <x-datatable.add-new :route="route('cafe.cards.create')" :title="__('datatable.add_new_card_groups')" />
        <x-datatable.filters :filters="$filters" :nas="$nas">

        </x-datatable.filters>
    </x-slot>

    <x-slot name="thead">
        <x-table-thead :columns="__('datatable.cafe_cards_groups_index')">
            <th>
                <span class="ps-5">#</span>
                <span style="padding-right: 0px;">
                    {{ __('datatable.admin_cards_groups_index_key') }}
                </span>
            </th>
        </x-table-thead>
    </x-slot>

    <x-slot name="tbody">
        @if ($paginatedData && count($paginatedData) > 0)
            @foreach ($paginatedData as $index => $model)
                <tr class="fw-bold bs-3 @if ($model->cards_count > 0) border-success @endif">
                    <td class="py-2">
                        @include('backend.cafe.cards.includes.optional_box')
                    </td>
                    <td class="no-padding">
                        <span
                            class="badge b-2 @if ($model->cards_count > 0) border-success
                        @else
                            border-dark @endif badge-dark badge-pill">
                            {{ $model->count }}
                        </span>
                    </td>
                    <td class="no-padding">
                        <span
                            class="badge b-2 @if ($model->cards_count > 0) border-success
                        @else
                            border-dark @endif badge-dark badge-pill">
                            {{ $model->cards_count }}
                        </span>
                    </td>
                    <td class="no-padding">
                        <span
                            class="badge b-2 @if ($model->cards_count > 0) border-success
                        @else
                            border-dark @endif badge-dark badge-pill">
                            {{ $model->count - $model->cards_count }}
                        </span>
                    </td>
                    <td class="no-padding">
                        <span
                            class="badge b-2 @if ($model->cards_count > 0) border-success
                        @else
                            border-dark @endif badge-dark badge-pill">
                            {{ $model->count * $model->offer_price }}
                        </span>
                    </td>
                    <td class="no-padding">
                        <a href="{{ route('cafe.offers.edit', $model->offer_id) }}">
                            <span class="badge badge-info badge-pill">
                                {{ $model->offer_name }}
                            </span>
                        </a>
                    </td>
                    <td class="no-padding">
                        <a href="{{ route('cafe.nas.edit', $model->nas_id) }}">
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
