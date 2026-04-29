<tr class="fw-bold user-info ags-user-row">
    <td class="w-auto user-status text-nowrap align-middle">
        @include('backend.includes.users_index_menu')
    </td>
    <td class="px-1 align-middle">
        <span dir="auto">
            <a href="{{ route('admins.users.edit', $model->id) }}" class="text-white">
                {{ $model->fullname }}
            </a>
        </span>
    </td>
    @include('backend.admins.users.includes.global_search_user_column_cells', [
        'model' => $model,
        'tableColumns' => $tableColumns,
    ])
</tr>
