 <div class="col-lg-4">
     <div
         class="@if ($loop->index == 1) box p-40 px-xs-5 py-xs-10 text-center bg-danger @else{{ $class['last_div'] }} @endif">
         <h4
             class="
                                @if ($loop->index == 1) text-white @else text-primary @endif">
             {{ $plan['name'] }}
         </h4>
         <h3 class="price @if ($loop->index == 1) text-white @else text-primary @endif">
             <sup>جنيه</sup>{{ $plan['price'] }}
             <sup>شهريا</sup>
             <span class="fs-18 d-none d-sm-block">
                 يضاف 55 جنيه عند الاشتراك اول مرة
             </span>
             <span class="d-block d-sm-none fw-bold">
                 يضاف 55 جنيه عند الاشتراك اول مرة
             </span>
         </h3>
         <a class="btn btn-outline btn-round @if ($loop->index == 1) btn-white @else btn-primary @endif"
             href="{{ route('home.register', $plan['id']) }}">@lang('frontend.plans_register')</a>

         <ul class="list-unstyled mt-10 mb-0 fw-bold text-white">
             <li class="py-10"><b>{{ $plan['users'] }}</b>
                 عدد كروت الشحن
             </li>
             <li class="py-10"><b>{{ $plan['cards'] }}</b>
                 عدد الكروت للطباعه
             </li>
             <li class="py-10"><b>{{ $plan['card_desgins'] }}</b>
                 عدد التصاميم للكروت
             </li>
             <li class="py-10"><b>{{ $plan['offers'] }}</b>
                 @lang('frontend.plans_offers')</li>
         </ul>
     </div>
 </div>
