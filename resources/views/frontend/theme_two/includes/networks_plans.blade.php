<div class="span4 price-column custom-card " >
    <h3>
        {{ $plan['name'] }}
    </h3>
    @php
        //$isSessionCurrencyCodeEGP = true;
        if ($isSessionCurrencyCodeEGP) {
            $planPrice =  $plan['price'];
        } else {
            $planPrice = $plan['price_dollar'];
        }
    @endphp
    <ul class="list"  >
            <li style="font-size:32px;" >
                <strong style="line-height:1.6!important;font-size:19px">
                    {{ trans("home.new_home.plans.price",['price' => $planPrice, 'currency' => $sessionCurrencyCode]) }}
                </strong>
            </li>
        <li>
            <strong style="line-height:1.6!important;font-size:19px">
                @lang('frontend.plans_servers')
                <div style="display:inline-flex">
                    ( {{ $plan['servers'] }} )
                </div>
            </strong>
        </li>
        <li>
            <strong style="line-height:1.6!important;font-size:19px">
                @lang('frontend.plans_users')
                <div style="display:inline-flex">
                    ( {{ $plan['users'] }} )
                </div>
            </strong>
        </li>
        <li>
            <strong style="line-height:1.6!important;font-size:19px">
                @lang('frontend.plans_monthes')
                <div style="display:inline-flex">
                    ( {{ $plan['monthes'] }} )
                </div>
            </strong>
        </li>
        <li>
            <strong style="line-height:1.6!important;font-size:19px">
                {{ trans("home.new_home.plans.cards",['cards' => $plan['cards']]) }}
            </strong>
        </li>
        <li>
            <strong style="line-height:1.6!important;font-size:19px">
                {{ trans("home.new_home.plans.card_desgins",['card_desgins' => $plan['card_desgins']]) }}
            </strong>
        </li>
        <li>
            <strong style="line-height:1.6!important;font-size:19px">
                @lang('frontend.plans_offers') ( {{ $plan['offers'] }} )
            </strong>
        </li>

        <li>
            <strong style="line-height:1.6!important;font-size:19px">
                    {{ trans("home.new_home.plans.additional_server",['price' => $additionalServerPrice, 'currency' => $sessionCurrencyCode]) }}

            </strong>
        </li>
    </ul>
    <a href="{{ route('theme_two.home.register', $plan['id']) }}" class="button button-ps" style="border-radius:5px">
        <strong>
            @lang('frontend.plans_register')
        </strong>
    </a>
</div>

@push('styles')
<style>
.custom-card {

    margin: 25px 10px !important;
    box-shadow: 0px 6px 16px 0px #1f1f1f;
    transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease ;
    flex: 1; /* Distribute available space evenly */

}

.custom-card:hover {
    background-color: whitesmoke;
    color: #ffffff;
    transform: translateY(-5px)  !important;
    box-shadow: -8px 15px 18px rgba(0, 0, 0, 0.4), -6px 0px 12px rgba(0, 0, 0, 0.2);
}

</style>
@endpush
