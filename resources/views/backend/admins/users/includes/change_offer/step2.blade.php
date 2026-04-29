 <div class="d-flex flex-row justify-content-center">
     <div class="alert text-bold">
         <div>
             <span>
                 {{ __('site.user_index.changeOffer.price') }}
             </span>
             <span class="text-warning fs-18">
                 {{ optional(optional($newOffer)->render())->price() }}
             </span>
         </div>
         <div>
             <span>
                 {{ __('site.user_index.changeOffer.paied_price') }}
             </span>
             <span class="text-danger fs-18">
                 {{ $paied_price . ' جنيه' }}
             </span>
         </div>
         <div>
             <span>
                 {{ __('site.user_index.changeOffer.minus') }}
             </span>
             @if ($invoiceStatus == 0)
                 <span class="text-primary">
                     {{ $priceOver . ' جنيه' }}
                 </span>
                 <div class="py-1">
                     <span class="text-primary">
                         {{ __('site.user_index.changeOffer.no_paied_invoice', [
                             'price' => $priceOver,
                         ]) }}
                     </span>
                 </div>
             @else
                 @if ($priceOver == 0)
                     <span class="text-success">
                         {{ __('site.user_index.changeOffer.no_minus') }}
                     </span>
                     <div class="py-1">
                         <span class="text-primary">
                             {{ __('site.user_index.changeOffer.paied_invoice') }}
                         </span>
                     </div>
                 @else
                     <span class="text-success">
                         {{ __('site.user_index.changeOffer.no_minus') }}
                     </span>
                     <div class="py-1">
                         <span class="text-primary text-wrap">
                             {{ __('site.user_index.changeOffer.plus_invoice', [
                                 'price' => $priceOver,
                             ]) }}
                         </span>
                     </div>
                 @endif

             @endif
         </div>
     </div>
 </div>
