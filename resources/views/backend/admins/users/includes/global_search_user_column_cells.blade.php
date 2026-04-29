@foreach ($tableColumns as $key)
    @if ($key === 'fullname')
        @continue
    @endif
    @switch($key)
        @case('username')
            <td class="no-padding" dir="auto">
                {{ Str::substr($model->username, 0, 4) . '***' . Str::substr($model->username, -2) }}
            </td>
        @break

        @case('shared_users')
            <td class="no-padding">
                <a href="{{ route('admins.offers.edit', $model->offer_id) }}">
                    <span class="badge text-primary bg-dark fs-15 fw-bold">
                        {{ $model->shared_users }}
                    </span>
                </a>
            </td>
        @break

        @case('is_active')
            <td class="no-padding">
                @if ($model->is_active)
                    <i class="fa spi fa-snowflake-o fa-spin text-success"></i>
                    <span class="text-white px-1">
                        {{ $model->is_active }}
                    </span>
                @else
                    <i class="fa fa-circle text-danger"></i>
                @endif
            </td>
        @break

        @case('usage_quta')
            <td class="px-1 py-0">
                <x-quta-progress-render :quta-info="$model->getQutaInfo()" />
            </td>
        @break

        @case('expired_at')
            <td class="no-padding">
                <span class="badge badge-{{ $model->statusClass }} badge-pill fw-bold">
                    {{ $model->expiredDate }}
                </span>
            </td>
        @break

        @case('offer_name')
            <td class="no-padding">
                <a href="{{ route('admins.offers.edit', $model->offer_id) }}">
                    <span class="badge badge-info badge-pill">
                        {{ $model->offer_name }}
                    </span>
                </a>
            </td>
        @break

        @case('account')
            <td class="no-padding">
                <span class="badge badge-warning badge-pill">
                    {{ $model->account ?? 0 }}
                </span>
            </td>
        @break

        @case('debt_price')
            <td class="no-padding">
                @if ($model->debt_price > 0)
                    <span class="text-primary fs-17">
                        {{ number_format((float) $model->debt_price, 2) . ' ' . getViewCurrency() }}
                    </span>
                @else
                    <span class="text-success fs-17">
                        لا يوجد
                    </span>
                @endif
            </td>
        @break

        @case('nas_name')
            <td class="no-padding">
                <span class="badge badge-primary badge-pill">
                    {{ $model->nas_name }}
                </span>
            </td>
        @break

        @default
            <td class="no-padding text-muted small">—</td>
        @break
    @endswitch
@endforeach
