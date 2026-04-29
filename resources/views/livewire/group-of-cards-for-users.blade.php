<x-datatable :paginated-data="$paginatedData">

    <x-slot name="navBar">
        <div class="col-sm-12 col-md-6">
            <a href="{{ route('admins.cards.create') }}" class="btn btn-success btn-md ml-5 fw-bold">
                <i class="fa spi fa-plus px-2"></i>
                {{ __('datatable.add_new_card_groups') }}
            </a>
            <a href="{{ route('admins.card-import.index') }}" class="btn btn-primary btn-md ml-5 fw-bold">
                <i class="fa spi fa-upload px-2"></i>
                {{ __('datatable.upload_new_user') }}
            </a>
        </div>

        <x-datatable.filters :filters="$filters" :nas="$nas">

        </x-datatable.filters>
    </x-slot>

    <x-slot name="thead">
        <x-table-thead :columns="__('datatable.admin_cards_groups_index')">
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
                        @include('backend.admins.cards_groups.includes.optional_box')
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
                        <span class="badge badge-success badge-pill fw-bold">
                            {{ $model->admin_fullname ?? __('site.charging_with_admin') }}
                        </span>
                    </td>
                    <td class="no-padding">
                        <a href="{{ route('admins.offers.edit', $model->offer_id) }}">
                            <span class="badge badge-info badge-pill">
                                {{ $model->offer_name }}
                            </span>
                        </a>
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

@push('scripts')
    <script>
        function forceDeleteCardGroupAndCards() {
            return {
                customDelete(groupId) {
                    let message = '<span class="text-primary">';
                    message += 'هل انت متاكد من انك تريد حذف مجموعة الكروت نهائيا';
                    message += '</span>';

                    swalAlert(message).then((result) => {
                        if (result.isConfirmed) {
                            @this.call('forceDeleteCardGroupAndCards', groupId);
                        }
                    });
                },
            }
        }
    </script>
@endpush
