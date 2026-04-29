<!-- Price section start -->
@php
$isSessionCurrencyCodeEGP = isSessionCurrencyCodeEGP();
//$isSessionCurrencyCodeEGP = true;
if ($isSessionCurrencyCodeEGP) {
        $subscriptionFee = \App\Models\Setting::getSubscriptionFeePrice();
        $sessionCurrencyCode = "EGP";
        $additionalServerPrice = \App\Models\Setting::getBuyNasPrice();
        if (session('locale') == 'ar') {
            $sessionCurrencyCode = "جنيه مصري";
        }
    } else {
        $subscriptionFee = \App\Models\Setting::getSubscriptionFeePriceDollar();
        $sessionCurrencyCode = "USD";
        $additionalServerPrice = \App\Models\Setting::getBuyNasPriceDollar();
        if (session('locale') == 'ar') {
            $sessionCurrencyCode = "دولار أمريكي";
        }
    }
@endphp
<div id="price" class="section secondary-section">
    <div class="container">
        <div class="title">
            <h1 style="font-weight: bold;padding:5px;color:white;text-shadow:-1px 1px  #000;">
                {{ trans("home.new_home.plans.system_prices") }} {{ $system == App\ENUMS\PlanTypeEnum::TYPE_NETWORK ? trans("home.new_home.plans.networks")  : trans("home.new_home.plans.cafes") }}</h1>
            <h4 style="color: #1f1f1f">
                {{ trans("home.new_home.plans.small_description") }}
            </h4>
        </div>
		@if($system == App\ENUMS\PlanTypeEnum::TYPE_CAFE)
			<div>
				@include('frontend.theme_two.includes.cafe_features')
			</div>
		@endif

		@if($system == App\ENUMS\PlanTypeEnum::TYPE_NETWORK)
			<div>
				@include('frontend.theme_two.includes.network_features')
			</div>
		@endif
		<div class="">
            <div class=" custom-card-container">
                @foreach ($plans as $plan)
                    @include('frontend.theme_two.includes.' . $view)
                @endforeach

            </div>
		</div>
            <div class="centered" style="margin-top: 50px;background-color:#1f1f1f;padding:20px 10px 10px 10px;border-radius:15px;color:white;line-height:1.6">
                <p><b><font>
                    {{ trans("home.new_home.plans.first_subscription_add_price",['price' => $subscriptionFee, 'currency' => $sessionCurrencyCode]) }}
                </font></b></p>
            </div>
    </div>
</div>
        <!-- Price section end -->
@push('styles')
<style>
.custom-card-container {
    display: grid;
	grid-template-columns:1fr 1fr 1fr;
    margin: -25px -10px; /* Compensate for the negative margins on cards */
}

 @media (max-width: 768px) {
 .custom-card-container {
    width: 100%;
	grid-template-columns:1fr;
 }
</style>
@endpush
