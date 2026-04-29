<div class="span4 price-column custom-card ">
    <h3>
		<strong>
			{{ $plan['name'] }}
		</strong>
    </h3>
    <ul class="list">
            <li style="font-size:32px;">
                <strong>
                    {{ trans("home.new_home.plans.price",['price' => $plan['price']]) }}
                </strong>
            </li>
        <li>
            <strong>
                @lang('frontend.plans_servers') ( {{ $plan['servers'] }} )
            </strong>
        </li>
        <li>
            <strong>
                @lang('frontend.plans_users')  ( {{ $plan['users'] }} )
            </strong>
        </li>
        <li>
            <strong>
                @lang('frontend.plans_monthes') ( {{ $plan['monthes'] }} )
            </strong>
        </li>
        <li>
            <strong>
                {{ trans("home.new_home.plans.cards",['cards' => $plan['cards']]) }}
            </strong>
        </li>
        <li>
            <strong>
                {{ trans("home.new_home.plans.card_desgins",['card_desgins' => $plan['card_desgins']]) }}
            </strong>
        </li>
        <li>
            <strong>
                @lang('frontend.plans_offers') ( {{ $plan['offers'] }} )
            </strong>
        </li>

        <li>
            <strong>
                {{ trans("home.new_home.plans.additional_server",['price' => \App\Models\Setting::getBuyNasPrice() ]) }}
            </strong>
        </li>
    </ul>
    <a href="https://cafe.connect4ar.com/register/{{ $plan['id'] }}" class="button button-ps" style="border-radius:5px">
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
}

.custom-card:hover {
    background-color: whitesmoke;
    color: #ffffff;
    transform: translateY(-5px)  !important;
    box-shadow: -8px 15px 18px rgba(0, 0, 0, 0.4), -6px 0px 12px rgba(0, 0, 0, 0.2);
}

</style>
@endpush
