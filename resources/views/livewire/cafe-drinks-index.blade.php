<x-datatable :paginated-data="$paginatedData">

    <x-slot name="navBar">
        <x-datatable.add-new :route="route('cafe.drinks.create')" :title="__('datatable.add_new_drink')" />

        <div class="col-sm-12 col-md-6">
            <x-datatable.table-search />
        </div>
    </x-slot>

    <x-slot name="thead">
        <x-table-thead :columns="__('datatable.cafe_drinks_index')">
            <th>
                <span class="ps-5">#</span>
                <span style="padding-right: 5px;">
                    {{ __('datatable.cafe_drink_index_key') }}
                </span>
            </th>
        </x-table-thead>
    </x-slot>

    <x-slot name="tbody">

        @if ($paginatedData && count($paginatedData) > 0)
        @foreach ($paginatedData as $index => $model)
        <tr>
            <td class="py-2">
                @include('backend.optionalBox.cafe_drinks_index_menu')
            </td>

            <td class="no-padding">
                <span class="badge badge-warning badge-pill">
                    {{ $model->price . ' جنيه' }}
                </span>
            </td>

            <td class="py-1">
                @if ($model->image)
                <img src="{{asset($model->image)}}" class="b-1 border-primary rounded-circle" width="60px"
                    height="60px">
                @else

                <i class="fa fa-coffee text-primary rounded-circle b-1 border-primary fs-40 p-2"></i>

                @endif
            </td>

        </tr>
        @endforeach
        @else
        <x-datatable.empty-records />
        @endif

    </x-slot>
</x-datatable>
