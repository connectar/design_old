 <form wire:submit="save">
     <div class="box box-bordered border-danger m-0 no-padding">
         <div class="box-header with-border py-3">
             <h4 class="box-title">
                 {{ __('site.user_index.renew_all.title') }}
             </h4>
         </div>
         <div class="box-body no-padding">
             <div class="box border-success m-0">
                 <!-- /.box-header -->
                 <div class="box-body">
                     <div class="p-2">
                         @error('userId')
                             <span class="error text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                     <div class="row">
                         <div class="col-12">
                             <div class="form-group row">
                                 <label for="fullname" class="col-sm-2 col-form-label">
                                     {{ __('adding.user_option.change_offer_date') }}
                                 </label>
                                 <div class="col-sm-10">
                                     <select class="form-control" wire:model="dateRangeSelected">
                                         @foreach ($dateRanges as $key => $langKey)
                                             <option value="{{ $key }}">
                                                 {{ $langKey }}
                                             </option>
                                         @endforeach
                                     </select>
                                 </div>
                             </div>
                             @error('expired_at')
                                 <span class="error text-danger">{{ $message }}</span>
                             @enderror
                         </div>
                         @if ($showPickAday)
                             <div class="col-12">
                                 <div class="form-group row">
                                     <label for="fullname" class="col-sm-2 col-form-label">
                                         {{ __('adding.user_option.change_offer_started_at') }}
                                     </label>
                                     <div class="col-sm-10">
                                         <input class="form-control" type="text" id="datepicker"
                                             wire:model.lazy="other_date">
                                     </div>
                                 </div>
                                 @error('other_date')
                                     <span class="error text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                         @endif
                         <div class="col-12">
                             <div class="form-group row">
                                 <label for="fullname" class="col-sm-2 col-form-label">
                                     {{ __('adding.user_option.change_offer_payment_title') }}
                                 </label>
                                 <div class="col-sm-10">
                                     <div>
                                         <input name="invoiceStatus" wire:model="invoiceStatus"
                                             type="radio" id="radio_32"
                                             class="with-gap radio-col-success" value="1">
                                         <label for="radio_32">
                                             {{ __('adding.user_option.change_offer_payment.1') }}
                                         </label>
                                         <input name="invoiceStatus" wire:model="invoiceStatus"
                                             type="radio" id="radio_36"
                                             class="with-gap radio-col-danger" value="0">
                                         <label for="radio_36">
                                             {{ __('adding.user_option.change_offer_payment.0') }}
                                         </label>
                                     </div>
                                 </div>
                             </div>
                             @error('expired_at')
                                 <span class="error text-danger">{{ $message }}</span>
                             @enderror
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <!-- /.box-body -->
         <div class="box-footer p-2">
             <div class="pull-right">
                 <a href="#" data-bs-dismiss="modal" wire:click="buttonCancelClicked"
                     class="btn btn-danger">
                     {{ __('website.cancel') }}
                 </a>
                 <button type="submit" class="btn btn-success">
                     @lang('website.save')
                 </button>
             </div>
         </div>
     </div>
 </form>
 <!-- /.box -->
