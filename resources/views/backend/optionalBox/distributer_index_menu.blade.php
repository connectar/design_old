<div class="dropdown">
    <div class="clearfix pull-left">
        <span class="badge badge-dark b-1 border-warning">
            @if ($page != 1)
                {{ $loop->index + 1 + $perPage * ($page - 1) }}
            @else
                {{ $loop->index + 1 }}
            @endif
        </span>
        <span
            class="dropdown-toggle badge @if ($model->cards_count > 0) badge-success
        @else badge-warning @endif badge-pill"
            data-bs-toggle="dropdown">
            <span dir="auto">
                {{ $model->fullname }}
            </span>
        </span>

        <div class="dropdown-menu dropdown-menu-end fw-bold">
            <a class="dropdown-item py-2 fw-bold fw-bold"
                href="{{ route('admins.distributors.edit', $model->id) }}">
                <i class="fa fa-pencil"></i>
                {{ __('site.user_index.option.edit') }}
            </a>
            <a class="dropdown-item py-2 fw-bold" href="#"
                wire:click="$dispatch('charge','{{ $model->id }}')">
                <i class="fa fa-money text-success"></i>
                {{ __('site.distributer_index.charge') }}
            </a>
            <a class="dropdown-item py-2 fw-bold" href="#"
                wire:click="showDeletedBox('{{ $model->id }}')">
                <i class="fa fa-trash-o text-danger"></i>
                {{ __('site.user_index.option.delete') }}
            </a>
            <a class="dropdown-item py-2 fw-bold" href="{{route('admins.distributor.profit',$model->id)}}">
                <i class="fa fa-line-chart text-success"></i>
                {{ __('site.user_index.option.profit') }}
            </a>
            <a class="dropdown-item py-2 fw-bold" href="{{route('admins.statistic.expenses.distributor',$model->id)}}">
                <i class="fa fa-dollar text-primary"></i>
                {{ __('new_trans.ticket.datatable.admin_expense_table_title') }}
            </a>
        </div>
    </div>
</div>
