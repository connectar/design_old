@props([
    'message' => '',
    'messageTwo' => '',
    'contactNumbers' => null,
    'systemDistributor' => null,
    'actionUrl' => null,
    'numbers' => true,
])
<p class="pt-2" style="font-weight:600!important; ">
    {{ $message }}
</p>

@if ($systemDistributor)
    <div style="font-weight:600!important; ">
        موزع الشبكة :
        {{ $systemDistributor->fullname }}
        ({{ $systemDistributor->countryName }})
    </div>
@endif

<span class="d-block my-2">
    {{ $messageTwo }}
    <span dir="auto" class="fs-24">
        @if ($systemDistributor)
            <span class="">{{ $systemDistributor->phone }}</span>
            @if ($systemDistributor->other_phone)
                <span class="text-warning px-2">او</span>
                <span class="text-black">{{ $systemDistributor->other_phone }}</span>
            @endif
        @elseif ($numbers == true)
            <span>010</span>
            <span class="text-warning">122</span>
            <span class="text-black">122</span>
            <span>94</span>
        @endif
    </span>
    {{ $slot }}
</span>

@if ($actionUrl ?? null)
    {{ __('site.network_account_view.debt_message_3') }}
    <a class="btn btn-sm btn-dark text-primary" href="{{ $actionUrl }}" target="_blank">
        {{ __('new_trans.click_here') }}
    </a>
@endif
