 <form>
     <div class="box box-bordered border-danger m-0 no-padding">
         <div class="box-header with-border py-3">
             <h4 class="box-title">
                 {{ __('site.user_index.renew.title') }}
                 <span class="badge text-primary px-2 fs-16">
                     {{ $userName }}
                 </span>
             </h4>
         </div>
         <div class="box-body no-padding">
             @if ($step == 0)
                 <div class="px-4 mt-1">
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
             @endif
             @if ($step == 2)
                 @include('backend.admins.users.includes.renew.step2')
             @endif
             @if ($step == 3)
                 <div class="px-4 mt-4">
                     <div class="alert text-center text-bold">
                         <h4 class="text-bold text-primary h4">
                             <i class="icon fa fa-warning"></i>
                             <span class="text-danger">
                                 {{ $errorMessage }}
                             </span>
                         </h4>
                     </div>
                 </div>
             @endif
             @if ($step == 4)
                 @include('backend.admins.users.includes.alert', [
                     'key' => 'renew',
                 ])
             @endif
             @if ($step == 1)
                 @include('backend.admins.users.includes.renew.step1')
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
                 @elseif($step == 1)
                     <a href="#" class="btn btn-success text-bold"
                         wire:click="prepareDataBeforeSave('2')">
                         {{ __('site.user_index.changeOffer.next') }}
                     </a>
                 @elseif ($step == 2)
                     <a href="#" class="btn btn-warning text-bold"
                         wire:click="$set('step','1')">
                         {{ __('site.user_index.changeOffer.back') }}
                     </a>
                     <button type="button" class="btn btn-success" x-on:click="userRenew()">
                         @lang('website.save')
                     </button>
                 @endif
             </div>
         </div>
     </div>
 </form>
 <!-- /.box -->
