<x-datatable :paginated-data="$paginatedData">
    <x-slot name="navBar">
        <x-datatable.add-new :route="route('cafe.cards.create')" :title="__('datatable.add_new_card_groups')" />

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
        @if ($filterIsDisabled)
            <x-table-thead :columns="__('datatable.cafe_cards_for_users_disabled')">
                <th>
                    <span class="ps-5">#</span>
                    <span style="padding-right: 0px;">
                        {{ __('datatable.admin_cards_for_users_key') }}
                    </span>
                </th>
            </x-table-thead>
        @else
            <x-table-thead :columns="__('datatable.cafe_cards_for_users')">
                <th>
                    <span class="ps-5">#</span>
                    <span style="padding-right: 0px;">
                        {{ __('datatable.admin_cards_for_users_key') }}
                    </span>
                </th>
            </x-table-thead>
        @endif
    </x-slot>

    <x-slot name="tbody">

        @if ($paginatedData && count($paginatedData) > 0)
            @foreach ($paginatedData as $index => $model)
                @if ($filterIsDisabled)
                    <tr class="fw-bold">
                        <td class="py-2">
                            <div class="clearfix pull-left">
                                <span class="badge badge-dark b-1 border-warning">
                                    @if (($page ?? 1) != 1)
                                        {{ $loop->index + 1 + $perPage * (($page ?? 1) - 1) }}
                                    @else
                                        {{ $loop->index + 1 }}
                                    @endif
                                </span>
                                <span class="badge badge-danger">
                                    <span dir="auto">
                                        {{ $model->username }}
                                    </span>
                                </span>
                            </div>
                        </td>
                        <td class="no-padding">
                            <span class="badge badge-info">
                                {{ $model->offer_name }}
                            </span>
                        </td>
                        <td class="no-padding">
                            <span class="badge">
                                {{ $model->expired_at ?? '---' }}
                            </span>
                        </td>
                        <td class="no-padding">
                            <span class="badge badge-success fw-bold">
                                {{ $model->nas_name }}
                            </span>
                        </td>

                        <td class="no-padding">
                            <span class="badge text-primary fw-bold">
                                <i
                                    class="{{ __('site.cards_for_users.expired_reason_icon.' . $model->expired_reason) }}"></i>
                                {{ __('site.cards_for_users.expired_reason.' . $model->expired_reason) }}
                            </span>
                        </td>
                    </tr>
                @else
                    <tr
                        class="fw-bold bs-3 @if ($model->cards_count > 0) border-success @endif">
                        <td class="py-2">
                            @include('backend.cafe.cards.includes.cards-for-users')
                        </td>
                        <td class="no-padding">
                            <span
                                class="badge b-2 @if ($model->cards_count > 0) border-success
                        @else
                            border-dark @endif badge-dark badge-pill">
                                {{ $model->price }}
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
                            <span
                                class="badge b-2 @if ($model->cards_count > 0) border-success
                        @else
                            border-dark @endif badge-dark badge-pill">
                                {{ $model->expired_at ?? '---' }}
                            </span>
                        </td>
                        <td class="px-1 py-0">
                            <x-quta-progress-render :quta-info="$model->getQutaInfo()" />
                        </td>
                        <td class="no-padding">
                            <a href="{{ route('cafe.nas.edit', $model->nas_id) }}">
                                <span class="badge badge-primary badge-pill fw-bold">
                                    {{ $model->nas_name }}
                                </span>
                            </a>
                        </td>
                    </tr>
                @endif
            @endforeach
        @else
            <x-datatable.empty-records />
        @endif

    </x-slot>
</x-datatable>
