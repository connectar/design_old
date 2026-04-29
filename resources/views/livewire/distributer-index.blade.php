<x-datatable :paginated-data="$paginatedData">

    <x-slot name="navBar">

        <div class="col-sm-12 col-md-6">
            <a href="{{ route('admins.distributors.create') }}" class="btn btn-success btn-md ml-5 fw-bold">
                <i class="fa spi fa-plus px-2"></i>
                {{ __('datatable.add_new_distributer') }}
            </a>
            <a href="{{ route('admins.statistic.debts') }}" class="btn btn-danger btn-md ml-5 fw-bold">
                <i class="fa spi fa-minus px-2"></i>
                {{ __('new_trans.new_debts.title') }}
            </a>
            <a href="https://www.youtube.com/watch?v=TldCnmnGcMU" target="_blank"  class=" mx-2 p-2 btn btn-sm btn-danger " style="">
                <i class="fa fa-youtube  px-2" style="font-size:20px;" ></i>
                الشرح
            </a>
        </div>
        <div class="col-sm-12 col-md-6">
            <x-datatable.table-search />
        </div>
    </x-slot>

    <x-slot name="thead">
        <x-table-thead :columns="__('datatable.distributers_index')">
            <th>
                <span class="ps-5">#</span>
                <span style="padding-right: 30px;">
                    {{ __('datatable.distributers_index_key') }}
                </span>
            </th>
        </x-table-thead>
    </x-slot>

    <x-slot name="tbody">
        @if ($paginatedData && count($paginatedData) > 0)
            @foreach ($paginatedData as $index => $model)
                <tr>
                    <td class="py-2">
                        @include('backend.optionalBox.distributer_index_menu')
                    </td>
                    <td>
                        <span class="badge badge-info">
                            {{ $model->name }}
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-dark">
                            {{ $model->phone }}
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-primary">
                            {{ $model->users_count }}
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-success">
                            {{ $model->account }}
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-danger">
                            {{ $model->invoices_sum_price ?? 0 }}
                        </span>
                    </td>
                </tr>
            @endforeach
        @else
            <x-datatable.empty-records />
        @endif
    </x-slot>
</x-datatable>
@push('scripts')
    {{-- <script src="{{ asset('assets/includes/users_index.js') }}"></script> --}}
@endpush
