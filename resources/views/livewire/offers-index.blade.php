<div>
<x-datatable :paginated-data="$paginatedData">

    <x-slot name="navBar">
        <div class="col-sm-12 col-md-6 d-flex align-items-center gap-2">
            <x-datatable.add-new :route="route('admins.offers.create')"
                :title="__('datatable.add_new_offer')" />
            @if (authIsSuperAdmin())
                <button type="button" class="btn btn-primary btn-md fw-bold"
                    onclick="window.submitSelectedOffersDelete && window.submitSelectedOffersDelete()">
                    <i class="fa fa-check-square-o px-2"></i>
                    حذف المحدد
                </button>
            @endif
        </div>

        <div class="col-sm-12 col-md-6">
            <x-datatable.table-search />
        </div>
    </x-slot>

    <x-slot name="thead">
        <x-table-thead :columns="__('datatable.admin_offer_index')">
            <th>
                @if (authIsSuperAdmin())
                    <span class="h-20 flex-shrink-0 pull-left">
                        <input type="checkbox" id="offers-select-all" class="filled-in chk-col-success" />
                        <label for="offers-select-all"></label>
                    </span>
                @endif
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
                        @include('backend.optionalBox.offers_index_menu')
                    </td>
                    <td class="p-0" width="25px">
                        @if ($model->show)
                            <i class="fa fa-eye fs-22 text-success"></i>
                        @else
                            <i class="fa fa-eye-slash fs-22 text-muted"></i>
                        @endif
                    </td>
                    <td class="no-padding">
                        <span class="badge badge-primary badge-pill">
                            {{ $model->render()->speed() }}
                        </span>
                    </td>
                    <td class="no-padding">
                        <span class="badge badge-warning badge-pill">
                            {{ $model->ip_pool ?? '---' }}
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

@if (authIsSuperAdmin())
    <form id="offers-delete-selected-form" method="POST" action="{{ route('admins.offers.destroy_selected') }}"
        style="display:none;">
        @csrf
        @method('DELETE')
        <div id="offers-delete-selected-inputs"></div>
    </form>

    <script>
        (function() {
            function bindOffersSelection() {
                const selectAll = document.getElementById('offers-select-all');
                const items = Array.from(document.querySelectorAll('.offer-select-item'));
                if (!items.length) return;

                if (selectAll) {
                    selectAll.onchange = function() {
                        items.forEach((cb) => cb.checked = !!selectAll.checked);
                    };
                }
            }

            window.submitSelectedOffersDelete = function() {
                const selected = Array.from(document.querySelectorAll('.offer-select-item:checked'))
                    .map((el) => el.value);
                if (!selected.length) {
                    alert('اختر عرضًا واحدًا على الأقل.');
                    return;
                }
                if (!confirm('سيتم حذف العروض المحددة غير المرتبطة بمشتركين. هل تريد المتابعة؟')) {
                    return;
                }

                const form = document.getElementById('offers-delete-selected-form');
                const holder = document.getElementById('offers-delete-selected-inputs');
                holder.innerHTML = '';
                selected.forEach((id) => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'offer_ids[]';
                    input.value = id;
                    holder.appendChild(input);
                });
                form.submit();
            };

            bindOffersSelection();
            document.addEventListener('livewire:init', bindOffersSelection);
        })();
    </script>
@endif
</div>
