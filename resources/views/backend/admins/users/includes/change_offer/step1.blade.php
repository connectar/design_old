<div class="px-2">
    <table class="table table-borderless">
        <tr>
            <td class="py-1">العرض الحالى</td>
            <td class="py-1">
                <span class="text-white">
                    {{ $userOffer->name ?? '' }}
                </span>
            </td>
        </tr>
        <tr>
            <td class="py-1">حالة الاشتراك</td>
            <td class="py-1">
                @if ($userEndDate <= 0)
                    <span class="text-success">
                        لقد انتهى الاشتراك
                    </span>
                @else
                    <span class="text-primary">
                        * تحذير متبقى على انتهاء الاشتراك
                    </span>
                    <span class="fs-18 text-danger">
                        {{ humanizeSubscriptionRemaining($user->expired_at ?? null) }}
                    </span>
                @endif
            </td>
        </tr>
        <tr class="bg-dark">
            <td class="py-2 text-success">
                العرض الجديد
            </td>
            <td class="py-1">
                <span class="text-success">
                    {{ $newOffer->name ?? '' }}
                </span>
            </td>
        </tr>
    </table>
</div>
@include('backend.admins.users.includes.renew.step1_content')
