<!-- Start cSlider -->
<div id="da-slider" class="da-slider" dir="rtl">
    <div class="triangle"></div>
    <!-- mask elemet use for masking background image -->
    <div class="mask"></div>
    <!-- All slides centred in container element -->
    <div class="container">
        <!-- Start first slide -->
        <div class="da-slide">
            <h2 class="fittext2" style="{{app()->getLocale() != 'ar' ? 'margin-left:8%;':''}}"> {{trans('theme_two.slider.one.title')}}</h2>
            <h4>{{trans('theme_two.slider.one.title_two')}}</h4>
            <p>{{ trans('theme_two.slider.one.body')}} </p>
                <a href="{{ config('app.project_name') == 'cafe'
                            ? 'https://connect4ar.com/system/' . App\ENUMS\PlanTypeEnum::TYPE_NETWORK
                            : route('theme_two.system', App\ENUMS\PlanTypeEnum::TYPE_NETWORK) }}"
                    class="da-link button">
					@lang('frontend.plans_register')
                </a>
            <div class="da-img">
                <img src="{{ asset('new_frontend_theme/images/Slider01.png')}}" alt="image01" width="320">
            </div>
        </div>
        <!-- End first slide -->
        <!-- Start second slide -->
        <div class="da-slide">
			<div >
				<h2 > {{trans('theme_two.slider.two.title')}}</h2>
				<h4>{{trans('theme_two.slider.two.title_two')}}</h4>
				<p>{{trans('theme_two.slider.two.body')}}</p>
			</div>

            <a href="{{ config('app.project_name') == 'cafe'
                        ? route('theme_two.system', App\ENUMS\PlanTypeEnum::TYPE_CAFE)
                        : 'https://cafe.connect4ar.com/system/' . App\ENUMS\PlanTypeEnum::TYPE_CAFE }}"
                    class="da-link button">
				@lang('frontend.plans_register')
            </a>
            <div class="da-img">
                <img src="{{ asset('new_frontend_theme/images/Slider02.png')}}" width="320" alt="image02">
            </div>
		</div>
        <!-- End second slide -->
        <!-- Start third slide -->
        <div class="da-slide">
            <h2 style="{{app()->getLocale() != 'ar' ? 'margin-left:5%;':''}}">{{trans('theme_two.slider.three.title')}}</h2>

            <h4>{{ trans('theme_two.slider.three.title_two')}}</h4>
            <p>{{trans('theme_two.slider.three.body')}}</p>

            <a href="{{ config('app.project_name') == 'cafe'
                            ? route('theme_two.system', App\ENUMS\PlanTypeEnum::TYPE_CAFE_HOME)
                            : 'https://cafe.connect4ar.com/system/' . App\ENUMS\PlanTypeEnum::TYPE_CAFE_HOME }}" class="da-link button">
				@lang('frontend.plans_register')
            </a>
            <div class="da-img">
                <img src="{{ asset('new_frontend_theme/images/Slider03.png')}}" width="320" alt="image03">
            </div>
        </div>
        <!-- Start third slide -->
        <!-- Start cSlide navigation arrows -->
        <div class="da-arrows">
            <span class="da-arrows-prev"></span>
            <span class="da-arrows-next"></span>
        </div>
        <!-- End cSlide navigation arrows -->
    </div>
</div>
