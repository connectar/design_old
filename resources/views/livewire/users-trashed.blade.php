<div  x-data="{
    multiselect: [],
    isSelectAll: false,
    toggleAll() {
        this.isSelectAll = !this.isSelectAll;
        if (this.isSelectAll) {
            this.multiselect = Array.from(document.querySelectorAll('input.deleted_users_table_checkbox:not(#md_checkbox_all)')).map(cb => cb.value);
        } else {
            this.multiselect = [];
        }
    },
    // This call livewire action on the server to do with the multiselection
    restoreSelected() {
        @this.call('restoreSelected', this.multiselect);
    },
    deleteSelected() {
        @this.call('confirmForceDelete', this.multiselect);
    }
}">
    <x-datatable :paginated-data="$paginatedData">

        <x-slot name="navBar">
            <div class="d-block justify-content-between">

                    <div class="col-6">
                        <h4>

                            <span class="badge badge-info fw-bold">
                                {{ __('datatable.users_trashed_title') }}
                            </span>
                        </h4>
                    </div>

                    @if (session()->has('manager_login_key'))
                    <div class="col-6">
                        <button class="btn btn-success btn-sm col-md-2 fw-bold me-2" @click="restoreSelected">
                            <i class="fa fa-undo"></i>
                            استعادة المحدد
                        </button>
                        <button class="btn btn-danger btn-sm col-md-2 fw-bold fw-bold"  @click="deleteSelected">
                            <i class="fa fa-trash"></i>
                            {{ __('site.user_index.option.force_delete') }}
                        </button>
                    </div>
                    @endif
            </div>
        </x-slot>

        <x-slot name="thead">
            <x-table-thead :columns="__('datatable.admin_user_trashed_index')">
                <th>
                    @if (session()->has('manager_login_key'))
                    <span class="h-20 flex-shrink-0 pull-left">
                        <input
                            type="checkbox"
                            id="md_checkbox_all"
                            class="filled-in chk-col-success checkedId"
                            @click="toggleAll()"
                            >
                        <label for="md_checkbox_all"></label>
                    </span>
                    @endif
                    <span class="ps-5">#</span>
                    <span>{{ __('datatable.users_online_key') }}</span>
                </th>
            </x-table-thead>
        </x-slot>

        <x-slot name="tbody">
            @if ($paginatedData && count($paginatedData) > 0)
                @foreach ($paginatedData as $index => $model)
                    <tr class="fw-bold">
                        <td>
                            @include('backend.includes.users_trashed_index_menu')
                        </td>
                        <td class="px-1">
                            <span dir="auto">
                                <a href="{{ route('admins.users.edit', $model->id) }}">
                                    {{ $model->fullname }}
                                </a>
                            </span>
                        </td>
                        <td class="no-padding">
                            {{ Str::substr($model->username, 0, 4) . '***' . Str::substr($model->username, -2) }}
                        </td>
                        <td class="no-padding">
                            <a href="{{ route('admins.offers.edit', $model->offer_id) }}">
                                <span class="badge badge-info badge-pill">
                                    {{ $model->offer_name }}
                                </span>
                            </a>
                        </td>
                        <td class="no-padding">
                            <span class="badge badge-primary badge-pill">
                                {{ $model->nas_name }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            @else
                <x-datatable.empty-records />
            @endif

        </x-slot>
    </x-datatable>
</div>
@push('scripts')
<script>
    window.addEventListener("showConfirmBox", (event) => {
        Swal.fire(event.detail.alert).then((result) => {
            if (result.isConfirmed) {
                (async function () {
                    const {
                        value: password
                    } = await Swal.fire({
                        title: "Enter your password",
                        input: "password",
                        inputLabel: "كلمة سر المدير",
                        inputPlaceholder: "اكتب كلمة السر الخاصه بمدير النظام",
                        showCancelButton: true,
                        cancelButtonText: "الغاء",
                        confirmButtonText: "استمرار",
                        inputValidator: (value) => {
                            if (!value) {
                                return "كلمة السر ضروريه لحذف المستخدمين بشكل نهائي";
                            }
                        },
                    });

                    if (password) {
                        Livewire.dispatch(
                            "confirmForceDeleteOperationForCollection",
                            event.detail.modelIds,
                            password
                        );
                    }
                })();
            }
        });
    });
</script>
@endpush
