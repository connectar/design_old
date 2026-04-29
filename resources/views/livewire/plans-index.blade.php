<x-datatable :paginated-data="$paginatedData">

    <x-slot name="navBar">
        <x-datatable.add-new :route="route('managers.plans.create')" :title="__('datatable.add_new_plan')" />
        <div class="col-sm-12 col-md-6">
            <x-datatable.table-search />
        </div>
        <div>
            <div class="box-header py-2">
                <span class="text-primary px-1">
                    <i class="fa fa-info text-primary px-1"></i>
                    النوع
                </span>
                <select class="form-select d-inline bg-lightest text-white" style="max-width: 250px" wire:model="type">
                    @foreach ($types as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </x-slot>

    <x-slot name="thead">
        <x-table-thead :columns="__('datatable.manager_plans_index_' . $type)">
            <th>
                <span class="ps-5">#</span>
                <span style="padding-right: 5px;">
                    {{ __('datatable.plans_key') }}
                </span>
            </th>
        </x-table-thead>
    </x-slot>

    <x-slot name="tbody">
        @if ($paginatedData && count($paginatedData) > 0)
            @foreach ($paginatedData as $index => $model)
                @if ($type == \App\ENUMS\PlanTypeEnum::TYPE_NETWORK)
                    <tr>
                        <td class="py-2">
                            @include('backend.managers.plans.includes.optional_box')
                        </td>
                        <td>
                            <span class="badge badge-info badge-pill">
                                {{ $model->country }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-info badge-pill">
                                {{ $model->currency }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-success badge-pill">
                                {{ $model->networks_count }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-info badge-pill">
                                {{ $model->users }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-primary badge-pill">
                                {{ $model->price }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-danger badge-pill">
                                {{ $model->offers }}
                            </span>
                        </td>

                        <td>
                            <span class="badge badge-warning badge-pill">
                                {{ $model->cards }}
                            </span>
                        </td>

                        <td>
                            <span class="badge badge-primary badge-pill">
                                {{ $model->charging }}
                            </span>
                        </td>

                    </tr>
                @else
                    <tr>
                        <td class="py-2">
                            @include('backend.managers.plans.includes.optional_box')
                        </td>
                        <td>
                            <span class="badge badge-info badge-pill">
                                {{ $model->country }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-info badge-pill">
                                {{ $model->currency }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-success badge-pill">
                                {{ $model->networks_count }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-info badge-pill">
                                {{ $model->users }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-primary badge-pill">
                                {{ $model->price }}
                            </span>
                        </td>

                        <td>
                            <span class="badge badge-warning badge-pill">
                                {{ $model->cards }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-danger badge-pill">
                                {{ $model->card_desgins }}
                            </span>
                        </td>
                    </tr>
                @endif
            @endforeach
        @else
            <x-datatable.empty-records />
        @endif
    </x-slot>
</x-datatable>
