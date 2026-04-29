<div class="row p-2">
    <div class="col-12">
        <div class="box">
            <div class="box-body ribbon-box">
                <div class="ribbon ribbon-info">
                    @lang('adding.offer.create_offer_name')
                    <strong>@lang('adding.offer.create_offer_month')</strong>
                </div>
                <p class="text-bold h5">
                    @lang('adding.offer.create_offer_month_content')
                </p>
                <a href="{{ route('admins.offers.create',['type' => 'month']) }}"
                    class="btn btn-dark btn-rounded">@lang('website.from_here')</a>
            </div> <!-- end box-body-->
        </div>
    </div>
    <div class="col-12">
        <div class="box">
            <div class="box-body ribbon-box">
                <div class="ribbon ribbon-info">
                    @lang('adding.offer.create_offer_name')
                    <strong>@lang('adding.offer.create_offer_hour')</strong>
                </div>
                <p class="text-bold h5">
                    @lang('adding.offer.create_offer_hour_content')
                </p>
                <a href="{{ route('admins.offers.create',['type' => 'hour']) }}"
                    class="btn btn-dark btn-rounded">@lang('website.from_here')</a>
            </div> <!-- end box-body-->
        </div>
    </div>

</div>
