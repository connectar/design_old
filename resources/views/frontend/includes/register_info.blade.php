 <div class="row justify-content-center">
     <div class="col-md-6 col-12">
         <div class="box box-info">
             <div class="box-body text-center py-xs-1">
                 <h4 class="box-title text-center">
                     <span>
                         <a href="{{ route('home.system', $plan->type) }}"
                             class="btn px-4 btn-secondary text-bold">
                             <span class="text-danger">
                                 {{ trans('site.home_index.change_system') }}
                             </span>
                         </a>
                     </span>
                     <span class="text-white h3">
                         تفاصيل الخطة
                     </span>
                 </h4>
                 <table class="table no-border" dir="rtl">
                     <tr class="text-white fw-bold">
                         <td class="py-0 text-wrap">
                             {{ trans('site.cafe_branches.create.plans.price') }}
                         </td>
                         <td class="py-0 fs-18">
                             {{ $plan->price }}
                         </td>
                     </tr>
                     <tr class="text-white fw-bold">
                         <td class="py-0 text-wrap">
                             {{ trans('site.cafe_branches.create.plans.users') }}
                         </td>
                         <td class="py-0 fs-18">
                             {{ $plan->users }}
                         </td>
                     </tr>
                     <tr class="text-white fw-bold">
                         <td class="py-0 text-wrap">
                             {{ trans('site.cafe_branches.create.plans.cards') }}
                         </td>
                         <td class="py-0 fs-18">
                             {{ $plan->cards }}
                         </td>
                     </tr>
                 </table>
             </div>
         </div>
     </div>
     <div class="col-md-6 col-12 d-none d-sm-block">
         <div class="box box-warning">
             <div class="box-body text-center">
                 <h4 class="box-title">
                     <span>
                         <a href="{{ route('home.system', ['system' => $plan->type == 1 ? 2 : 1]) }}"
                             class="btn px-4 btn-info text-bold">
                             <span class="text-white">
                                 {{ trans('site.home_index.change_system') }}
                             </span>
                         </a>
                     </span>
                     <span class="text-white h3">
                         تفاصيل النظام
                     </span>
                 </h4>

                 <table class="table no-border" dir="rtl">
                     <tr class="text-white fw-bold">
                         <td class="py-0 text-wrap">
                             اسم النظام
                         </td>
                         <td class="py-0 fs-18">
                             {{ __('site.home_index.current_system.' . $plan->type) }}
                         </td>
                     </tr>
                     <tr class="text-white fw-bold">
                         <td class="py-0 text-wrap">
                             حالة النظام
                         </td>
                         <td class="py-0 fs-18">
                             مستقر
                         </td>
                     </tr>
                     <tr class="text-white fw-bold">
                         <td class="py-0 text-wrap">
                             امان البيانات
                         </td>
                         <td class="py-0 fs-18">
                             نعم
                         </td>
                     </tr>
                 </table>
             </div>
         </div>
     </div>
     <div class="col-md-6 col-12 d-block d-sm-none">
         <div class="box box-warning">
             <div class="box-body text-center">
                 <a href="{{ route('home.system', ['system' => $plan->type == 1 ? 2 : 1]) }}"
                     class="btn px-4 btn-info text-bold">
                     <span class="text-white">
                         {{ trans('site.home_index.change_system') }}
                     </span>
                 </a>
                 <h4 class="box-title">
                     <span class="text-white h3">
                         {{ __('site.home_index.current_system_xs.' . $plan->type) }}
                     </span>
                 </h4>
             </div>
         </div>
     </div>
 </div>
