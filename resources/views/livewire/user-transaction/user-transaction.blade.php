<div>
    <x-datatable :paginated-data="$paginatedData">

        <x-slot name="navBar">
            <div class="col-sm-12 col-md-6">
                <!-- Status Explanation Button -->
                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                    data-bs-target="#statusExplanationModal">
                    شروحات
                    <i class="fa fa-question-circle fa-lg px-1">
                    </i>
                </button>
            </div>
            <div class="col-sm-12 col-md-6">
                <x-datatable.table-search />
            </div>
            <div class="d-flex justify-start gap-4">
                <div class="py-2">
                    <span class="text-primary px-2">الحالة</span>
                    <select class="form-select d-inline bg-lightest text-white" style="max-width: 250px"
                        wire:model="filterByStatus">
                        <option value="">الكل</option>
                        @foreach (\App\ENUMS\AdminUserTransactionEnum::getStatusLabels() as $index => $value)
                            <option value="{{ $index }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="py-2">
                    <span class="text-primary px-2">الموزع</span>
                    <select class="form-select d-inline bg-lightest text-white" style="max-width: 250px"
                        wire:model="filterByDistributorId">
                        <option value="">الكل</option>
                        @foreach ($distributors as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </x-slot>

        <x-slot name="thead">
            <x-table-thead :columns="__('datatable.user_transactions')">
                <th>
                    <div class="btn-group" role="group">
                        <span class="h-20 flex-shrink-0">
                            <input type="checkbox" id="checkAllItems" class="filled-in chk-col-success">
                            <label for="checkAllItems"></label>
                        </span>
                    </div>
                    <span class="badge">
                        <span class="ps-5">#</span>
                        <span>
                            {{ __('datatable.transaction_id') }}
                        </span>
                    </span>
                </th>
            </x-table-thead>
        </x-slot>

        <x-slot name="tbody">
            @if ($paginatedData && count($paginatedData) > 0)
                @foreach ($paginatedData as $index => $model)
                    <tr>
                        <td class="py-2">
                            <div class="dropdown">
                                <div class="clearfix pull-left">
                                    <span class="h-20 flex-shrink-0 pull-left">
                                        <input value="{{ $model->id }}" type="checkbox"
                                            id="md_checkbox_{{ $model->id }}"
                                            class="usersIds filled-in chk-col-success checkedId">
                                        <label for="md_checkbox_{{ $model->id }}"></label>
                                    </span>
                                    <span class="badge b-1 border-warning">
                                        @if (($page ?? 1) != 1)
                                            {{ $loop->index + 1 + $perPage * (($page ?? 1) - 1) }}
                                        @else
                                            {{ $loop->index + 1 }}
                                        @endif
                                    </span>

                                    {{-- <span class="dropdown-toggle badge badge-warning" data-bs-toggle="dropdown"> --}}
                                    <span class="badge badge-warning">
                                        <span dir="auto">
                                            {{ $model->transaction_id }}
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="p-2">
                            <span class="badge text-white">
                                {{ $model->admin_fullname ?? '---' }}
                            </span>
                        </td>
                        <td class="p-2">
                            <span class="badge text-white">
                                {{ $model->distributor_fullname ?? '---' }}
                            </span>
                        </td>
                        <td class="p-2">
                            <span class="badge text-white">
                                {{ $model->user_fullname ?? '---' }}
                            </span>
                        </td>
                        <td class="p-2" style="min-width: 150px;">

                            <!-- Badge as Dropdown Toggle -->
                            <div class="dropdown" x-data="ChangeTransactionStatusComponent">
                                <span
                                    class="badge text-white badge-{{ \App\ENUMS\AdminUserTransactionEnum::getStatusBadgeColors()[$model->status] ?? 'secondary' }} dropdown-toggle"
                                    role="button" id="statusDropdown{{ $model->id }}" data-bs-toggle="dropdown"
                                    aria-expanded="false" style="cursor: pointer;">
                                    <i
                                        class="{{ \App\ENUMS\AdminUserTransactionEnum::getStatusIcons()[$model->status] ?? 'fa fa-question' }}"></i>
                                    {{ \App\ENUMS\AdminUserTransactionEnum::getStatusLabels()[$model->status] ?? 'غير معروف' }}
                                </span>

                                <!-- Dropdown Menu -->
                                <ul class="dropdown-menu" aria-labelledby="statusDropdown{{ $model->id }}">
                                    @foreach (\App\ENUMS\AdminUserTransactionEnum::getStatusLabels() as $key => $label)
                                        <li>
                                            <a class="dropdown-item text-center text-white p-2 m-0  " href="#"
                                                x-on:click="changeStatus({{ $model->id }}, {{ $key }})">
                                                <i
                                                    class="{{ \App\ENUMS\AdminUserTransactionEnum::getStatusIcons()[$key] ?? 'fa fa-question' }} text-{{ \App\ENUMS\AdminUserTransactionEnum::getStatusBadgeColors()[$key] }}"></i>
                                                {{ $label }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </td>
                        <td class="no-padding">
                            <span class="badge badge-danger">
                                {{ $model->price }}
                            </span>
                        </td>
                        <td class="no-padding">
                            <span class="badge badge-info">
                                {{ $model->claim_code }}
                            </span>
                        </td>
                        <td class="no-padding">
                            <span class="badge badge-warning">
                                {{ $model->phone ?? '---' }}
                            </span>
                        </td>
                        <td class="no-padding">
                            <span class="badge badge-dark">
                                {{ $model->gateway === 'vodafone' ? 'فودفون كاش' : $model->gateway }}
                            </span>
                        </td>
                        <td class="no-padding">
                            <span class="badge badge-dark">
                                {{ $model->created_at }}
                            </span>
                        </td>
                        <td class="no-padding">
                            @if ($model->received_at)
                                <span class="badge badge-success">
                                    {{ $model->received_at }}
                                </span>
                            @else
                                ---
                            @endif
                        </td>
                        <td class="no-padding">
                            @if ($model->user_id)
                                <i class="fa fa-check text-success"></i>
                            @else
                                <i class="fa fa-clock-o"></i>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <x-datatable.empty-records />
            @endif

        </x-slot>

    </x-datatable>
    <!-- Bootstrap Modal -->
    <div class="modal fade" id="statusExplanationModal" tabindex="-1" aria-labelledby="statusExplanationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-sm">
                <div class="modal-header text-white">
                    <h5 class="modal-title" id="statusExplanationModalLabel">
                        شروحات
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="اغلاق"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-3">حالات عمليات التحويلات</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <strong>قيد الانتظار:</strong> العملية وصلت ولم يتم التعامل معها بعد.
                            </span>
                            <span class="badge bg-warning badge-lg rounded-pill">قيد الانتظار</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <strong>تمت المطالبة:</strong> العملية تم قبولها وتطبيقها على الحساب.
                            </span>
                            <span class="badge bg-dark rounded-pill">تمت المطالبة بكارت هوتسبوت</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <strong>تمت المطالبة بكارت هوتسبوت:</strong> العملية تم قبولها وتطبيقها على عميل غير
                                مسجل وتم شحن كارت هوتسبوت.
                            </span>
                            <span class="badge bg-success rounded-pill">تمت المطالبة</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <strong>منتهي الصلاحية:</strong> لم يتم المطالبة بالعملية وانتهت فترة السماح بالمطالبة.
                            </span>
                            <span class="badge bg-secondary rounded-pill">منتهي الصلاحية</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <strong>مرفوض:</strong> العملية تم رفضها لأسباب معينة.
                            </span>
                            <span class="badge bg-danger rounded-pill">مرفوض</span>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer d-flex justify-end">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
    <script>
        function ChangeTransactionStatusComponent() {
            return {
                open: false,
                changeStatus(id, status) {
                    let title = "هل انت متأكد من تغيير حالة العملية؟";
                    let text = "سوف يتم تغيير الحالة عند التأكيد.";
                    confirmWarningAlert(title, text, 'تأكيد').then((result) => {
                        if (result.isConfirmed) {
                            @this.call('changeStatus', id, status);
                        }
                    });

                }
            };
        }
    </script>
@endpush
