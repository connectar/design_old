<x-datatable :paginated-data="$paginatedData">

    <x-slot name="navBar">
        <div class="col-sm-12 col-md-6">
            <a href="{{ route('admins.cards.create_new_card') }}" class="btn btn-rounded btn-info btn-md ml-5">
                {{ __('datatable.add_new_card_groups') }}
            </a>
        </div>
        <div class="col-sm-12 col-md-6">
            <x-datatable.table-search />
        </div>
        @isset($filters)
            <x-datatable.filters :filters="$filters" :nas="$nas">
                {{-- add more filters here --}}
            </x-datatable.filters>
        @endisset
        <div class="row">
            <div class="col-5">
                main_box
            </div>
            <div class="col-7">
                <div class="btn-group" role="group">
                    <span class="badge badge-warning badge-pill fw-bold fs-17 py-2">
                        {{ __('site.card_groups_index.remain_cards') }}
                        <span class="px-2">200</span>
                    </span>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="thead">
        <x-table-thead :columns="__('datatable.admin_cards_groups_index')"
            :title="__('datatable.admin_cards_groups_index_key')" :action="false" />
    </x-slot>

    <x-slot name="tbody">
    @if($paginatedData && count($paginatedData) > 0)
        @foreach ($paginatedData as $index => $model)
            <tr class="fw-bold bs-3 @if ($model->cards_count > 0) border-success @endif">
                <td class="py-2">
                    @include('backend.admins.cards_gropus.includes.optional_box')
                </td>
                <td class="no-padding">
                    <span class="badge b-2 @if ($model->cards_count > 0) border-success
                    @else
                        border-dark @endif badge-dark badge-pill">
                        {{ $model->count }}
                    </span>
                </td>
                <td class="no-padding">
                    <span class="badge b-2 @if ($model->cards_count > 0) border-success
                    @else
                        border-dark @endif badge-dark badge-pill">
                        {{ $model->cards_count }}
                    </span>
                </td>
                <td class="no-padding">
                    <span class="badge b-2 @if ($model->cards_count > 0) border-success
                    @else
                        border-dark @endif badge-dark badge-pill">
                        {{ $model->count - $model->cards_count }}
                    </span>
                </td>
                <td class="no-padding">
                    <span class="badge b-2 @if ($model->cards_count > 0) border-success
                    @else
                        border-dark @endif badge-dark badge-pill">
                        {{ $model->count * $model->offer_price }}
                    </span>
                </td>
                <td class="no-padding">
                    <span class="badge badge-success badge-pill fw-bold">
                        {{ $model->admin_fullname ?? __('site.card_groups_index.all_distributors') }}
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
        <x-datatable.empty-records colspan="7" />
    @endif
    </x-slot>
</x-datatable>
@push('scripts')
    {{-- <script src="{{ asset('assets/includes/users_index.js') }}"></script> --}}
@endpush

