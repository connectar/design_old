<div x-data="{
    multiselect: [],
    isSelectAll: false,
    toggleAll() {
        this.isSelectAll = !this.isSelectAll;
        if (this.isSelectAll) {
            this.multiselect = Array.from(document.querySelectorAll('input.cards-users-trashed-checkbox:not(#cards_users_trashed_all)')).map(cb => cb.value);
        } else {
            this.multiselect = [];
        }
    },
    deleteSelected() {
        @this.call('confirmForceDelete', this.multiselect);
    },
    restoreSelected() {
        @this.call('restoreSelected', this.multiselect);
    }
}">
    <x-datatable :paginated-data="$paginatedData">
        <x-slot name="navBar">
            <div class="col-6">
                <h4><span class="badge badge-info fw-bold">سلة كروت الهوت سبوت</span></h4>
            </div>
            @if (session()->has('manager_login_key'))
                <div class="col-6">
                    <button class="btn btn-success btn-sm col-md-3 fw-bold me-2" @click="restoreSelected">
                        <i class="fa fa-undo"></i>
                        استعادة المحدد
                    </button>
                    <button class="btn btn-danger btn-sm col-md-3 fw-bold" @click="deleteSelected">
                        <i class="fa fa-trash"></i>
                        حذف نهائي المحدد
                    </button>
                </div>
            @endif
        </x-slot>

        <x-slot name="thead">
            <x-table-thead :columns="__('datatable.admin_cards_for_users')">
                <th>
                    @if (session()->has('manager_login_key'))
                        <span class="h-20 flex-shrink-0 pull-left">
                            <input type="checkbox" id="cards_users_trashed_all"
                                class="filled-in chk-col-success checkedId"
                                @click="toggleAll()">
                            <label for="cards_users_trashed_all"></label>
                        </span>
                    @endif
                    <span class="ps-5">#</span>
                </th>
            </x-table-thead>
        </x-slot>

        <x-slot name="tbody">
            @if ($paginatedData && count($paginatedData) > 0)
                @foreach ($paginatedData as $index => $model)
                    <tr>
                        <td>
                            <div class="dropdown">
                                <div class="clearfix pull-left">
                                    @if (session()->has('manager_login_key'))
                                        <span class="h-20 flex-shrink-0 pull-left">
                                            <input type="checkbox" id="card_user_trashed_{{ $model->id }}"
                                                value="{{ $model->id }}"
                                                class="filled-in chk-col-success cards-users-trashed-checkbox deleted_users_table_checkbox"
                                                x-model="multiselect">
                                            <label for="card_user_trashed_{{ $model->id }}"></label>
                                        </span>
                                    @endif
                                    <span class="badge badge-dark">{{ $loop->index + 1 + $perPage * (($page ?? 1) - 1) }}</span>
                                    <span class="dropdown-toggle badge badge-warning badge-pill" data-bs-toggle="dropdown">
                                        {{ $model->username }}
                                    </span>
                                    <div class="dropdown-menu dropdown-menu-end fw-bold">
                                        @if (session()->has('manager_login_key'))
                                            <a class="dropdown-item py-2 fw-bold" href="#"
                                                wire:click="restore('{{ $model->id }}')">
                                                <i class="fa fa-undo text-success"></i> استرجاع
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge badge-dark badge-pill">{{ $model->price }}</span></td>
                        <td><span class="badge badge-info badge-pill">{{ $model->offer_name }}</span></td>
                        <td><span class="badge badge-primary badge-pill">{{ $model->nas_name }}</span></td>
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
                    const { value: password } = await Swal.fire({
                        title: "Enter your password",
                        input: "password",
                        inputLabel: "كلمة سر المدير",
                        inputPlaceholder: "اكتب كلمة السر الخاصه بمدير النظام",
                        showCancelButton: true,
                        cancelButtonText: "الغاء",
                        confirmButtonText: "استمرار",
                        inputValidator: (value) => {
                            if (!value) return "كلمة السر ضروريه لحذف البيانات بشكل نهائي";
                        },
                    });
                    if (password) {
                        Livewire.dispatch("confirmForceDeleteOperationForCollection", event.detail.modelIds, password);
                    }
                })();
            }
        });
    });
</script>
@endpush
