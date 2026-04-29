{{-- جدول مطابق لقائمة المشتركين داخل مودال البحث العام --}}
@php
    $page = 1;
    $perPage = max(1, $users->count());
@endphp
<div class="ags-users-table-wrap table-responsive border rounded">
    <table class="table table-sm table-hover mb-0 ags-users-table">
        <thead>
            <tr class="text-warning">
                <th class="text-nowrap">
                    <div class="btn-group" role="group">
                        <span class="h-20 flex-shrink-0">
                            @if (authIsSuperAdmin())
                                <span class="sr-only">{{ __('datatable.admin_user_index.fullname') }}</span>
                            @endif
                        </span>
                    </div>
                    <span class="badge text-secondary bg-transparent px-0">
                        <span class="ps-2">#</span>
                        <span class="pe-2">{{ __('site.connection_type_title') }}</span>
                    </span>
                </th>
                <th>
                    <span class="badge text-secondary bg-transparent">{{ __('datatable.admin_user_index.fullname') }}</span>
                </th>
                @foreach ($tableColumns as $column)
                    @if ($column != 'fullname')
                        <th class="text-nowrap">
                            <span class="badge text-secondary bg-transparent">
                                {{ __('datatable.admin_user_index.' . $column) }}
                            </span>
                        </th>
                    @endif
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $model)
                @include('backend.admins.users.includes.global_search_user_row', [
                    'model' => $model,
                    'tableColumns' => $tableColumns,
                ])
            @endforeach
        </tbody>
    </table>
</div>
