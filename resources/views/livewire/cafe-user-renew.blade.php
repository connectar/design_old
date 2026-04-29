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
         <div class="box-body">
             @if ($step == 1)
                 <div class="text-center">
                     <h5 class="text-white">
                         هل انت متاكد من تجديد الاشتراك لهذا المشترك ؟
                     </h5>
                 </div>
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
                 <div class="px-4 mt-4">
                     <div class="alert text-center text-bold">
                         <span>
                             <i class="fa fa-check fs-40 text-success"></i>
                         </span>
                         <h4 class="text-bold">
                             <span class="">
                                 تم تجديد الاشتراك بنجاح
                             </span>
                         </h4>
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
                 @if ($step == 1)
                     <button type="button" class="btn btn-success" x-on:click="userRenew()">
                         @lang('website.save')
                     </button>
                 @endif
             </div>
         </div>
     </div>
 </form>
 <!-- /.box -->
