 <form wire:submit="save">
     <div class="box box-bordered border-danger m-0 no-padding">
         <div class="box-header with-border py-3">
             <h4 class="box-title">
                 {{ __('site.user_panel.renew_action.title') }}
                 <span class="badge text-primary px-2 fs-16">
                     {{ $userName }}
                 </span>
             </h4>
         </div>
         <div class="box-body no-padding">
             @if ($step == 0)
                 <div class="px-4 mt-3">
                     <div class="alert text-center text-bold">
                         <h4 class="text-bold">
                             <i class="icon fa fa-warning"></i>
                             {{ __('site.user_index.changeOffer.alert_title') }}
                         </h4>
                         <div>
                             {{ $processContent }}
                         </div>
                     </div>
                 </div>
             @else
                 <div class="box border-success m-0">
                     <!-- /.box-header -->
                     <div class="box-body">
                         <div class="text-center">
                             @if ($userEndDate > 0)
                                 <h5>
                                     <span class="text-primary">
                                         * تحذير متبقى على انتهاء الاشتراك
                                     </span>
                                    <span class="fs-18 text-danger">
                                        {{ humanizeSubscriptionRemaining($user->expired_at ?? null) }}
                                    </span>
                                 </h5>
                             @endif
                             <span class="text-center">
                                 {{ __('site.user_panel.renew_action.alert') }}
                             </span>
                         </div>
                     </div>
                 </div>
             @endif
         </div>
         <!-- /.box-body -->
         <div class="box-footer p-2">
             <div class="pull-right">
                 <a href="#" data-bs-dismiss="modal" wire:click="buttonCancelClicked"
                     class="btn btn-danger">
                     {{ __('website.cancel') }}
                 </a>
                 @if ($step == 0)
                     <a href="#" class="btn btn-success text-bold"
                         wire:click="goTofinalStep('{{ $userId }}')">
                         {{ __('site.user_index.changeOffer.continue') }}
                     </a>
                 @else
                     <button type="submit" class="btn btn-success">
                         @lang('website.ok')
                     </button>
                 @endif
             </div>
         </div>
     </div>
 </form>
 <!-- /.box -->
