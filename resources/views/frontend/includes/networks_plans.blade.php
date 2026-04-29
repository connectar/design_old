 <div class="col-lg-4">
     <div class="@if ($loop->index == 1) {{ $class['even_div'] }}@else{{ $class['last_div'] }} @endif"
         @if ($loop->index == 1)  @endif>
         <h4
             class="
                                @if ($loop->index == 1) text-white @else text-primary @endif text-uppercase">
             {{ $plan['name'] }}
         </h4>
         <h3 class="price @if ($loop->index == 1) text-white @else text-primary @endif">
             <sup>جنيه</sup>{{ $plan['price'] }}
             <sup>شهريا</sup>
             <span class="fs-18">
                 يضاف 55 جنيه عند الاشتراك اول مرة
             </span>
         </h3>
         <a class="btn btn-outline btn-round @if ($loop->index == 1) btn-white @else btn-primary @endif"
             href="{{ route('home.register', $plan['id']) }}">@lang('frontend.plans_register')</a>
         <ul class="list-unstyled mt-10 mb-0 fw-bold text-white">
             <li class="py-10"><b>{{ $plan['users'] }}</b>
                 @lang('frontend.plans_users')</li>
             <li class="py-10"><b>{{ $plan['servers'] }}</b>
                 @lang('frontend.plans_servers')</li>
             <li class="py-10"><b>{{ $plan['offers'] }}</b>
                 @lang('frontend.plans_offers')</li>
             <li class="py-10"><b>{{ $plan['monthes'] }}</b>
                 @lang('frontend.plans_monthes')</li>
             <li class="py-10 fw-bold text-primary">
                 <span dir="rtl">40 جنيه</span>
                 <span>
                     @lang('frontend.plans_new_nas')
                 </span>
             </li>
         </ul>
     </div>
 </div>
