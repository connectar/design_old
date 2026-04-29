<x-datatable :paginated-data="$paginatedData">

    <x-slot name="navBar">
        <x-datatable.add-new :route="route('cafe_home.offers.create')" :title="__('datatable.add_new_offer')" />

        <div class="col-sm-12 col-md-6">
            <x-datatable.table-search />
        </div>
    </x-slot>

    <x-slot name="thead">
        <x-table-thead :columns="__('datatable.cafe_offer_index')">
            <th>
                <span class="ps-5">#</span>
                <span style="padding-right: 5px;">
                    {{ __('datatable.admin_offer_index_key') }}
                </span>
            </th>
        </x-table-thead>
    </x-slot>

    <x-slot name="tbody">

        @if ($paginatedData && count($paginatedData) > 0)
            @foreach ($paginatedData as $index => $model)
                <tr>
                    <td class="py-2">
                        @include('backend.optionalBox.cafe_home_offers_index_menu')
                    </td>
                    <td class="no-padding">
                        <span class="badge badge-primary badge-pill">
                            {{ $model->render()->speed() }}
                        </span>
                    </td>
                    <td class="no-padding">
                        <span class="badge badge-info badge-pill">
                            {{ $model->render()->duration() }}
                        </span>
                    </td>
                    <td class="no-padding">
                        <span class="badge badge-success badge-pill">
                            {{ $model->render()->quta() }}
                        </span>
                    </td>
                    <td class="no-padding">
                        @foreach ($model->render()->filters() as $icon)
                            {!! __('site.filters_icons.' . $icon) !!}
                        @endforeach
                    </td>
                    <td class="no-padding">
                        <span class="badge badge-warning badge-pill">
                            {{ $model->render()->price() }}
                        </span>
                    </td>

                    <td class="sorting_1">
                        <span class="badge badge-danger badge-pill">
                            {{ $model['users_count'] }}
                        </span>
                    </td>

                </tr>
            @endforeach
        @else
            <x-datatable.empty-records />
        @endif

    </x-slot>
</x-datatable>
