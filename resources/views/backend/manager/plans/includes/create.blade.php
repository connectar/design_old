 @if ($using == App\Statuses\NetworkStatus::USING_IN_NETWORK)
     <div class="row">
         <div class="col-12">
             <div class="row">
                 <div class="col-md-4 col-sm-12">
                     <div class="form-group row">
                         <label for="plan_id" class="form-label">
                             {{ __('adding.plan.name_ar') }}
                         </label>
                         <div>
                             <div class="input-group">
                                 <div class="input-group-addon">
                                     <i class="fa  fa-paper-plane"></i>
                                 </div>
                                 <input class="form-control text-white" type="text" wire:model="planNameAr">
                             </div>
                             @error('planName')
                                 <span class="error text-danger">{{ $message }}</span>
                             @enderror
                         </div>
                     </div>
                 </div>
                 <div class="col-md-4 col-sm-12">
                     <div class="form-group row">
                         <label for="plan_id" class="form-label">
                             {{ __('adding.plan.name_en') }}
                         </label>
                         <div>
                             <div class="input-group">
                                 <div class="input-group-addon">
                                     <i class="fa  fa-paper-plane"></i>
                                 </div>
                                 <input class="form-control text-white" type="text" wire:model="planNameEn">
                             </div>
                             @error('planName')
                                 <span class="error text-danger">{{ $message }}</span>
                             @enderror
                         </div>
                     </div>
                 </div>
                 {{-- col-md-4 --}}
                 <div class="col-md-4 col-sm-12">
                     <div class="form-group row">
                         <label for="plan_price" class="form-label">
                             {{ __('adding.plan.price') }}
                         </label>
                         <div>
                             <div class="input-group">
                                 <div class="input-group-addon">
                                     <i class="fa fa-map-o"></i>
                                 </div>
                                 <input class="form-control text-white" type="text" min="1"
                                     wire:model="planPrice">
                             </div>
                         </div>
                         @error('planPrice')
                             <span class="error text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                 </div>
                 <div class="col-md-4 col-sm-12">
                     <div class="form-group row">
                         <label for="plan_price" class="form-label">
                             {{ __('adding.plan.price_dollar') }}
                         </label>
                         <div>
                             <div class="input-group">
                                 <div class="input-group-addon">
                                     <i class="fa fa-map-o"></i>
                                 </div>
                                 <input class="form-control text-white" type="text" min="1"
                                     wire:model="planPriceDollar">
                             </div>
                         </div>
                         @error('planPrice')
                             <span class="error text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                 </div>
                 <div class="col-md-4">
                     <div class="form-group row">
                         <label for="planUsers" class="form-label">
                             {{ __('adding.plan.users') }}
                         </label>
                         <div>
                             <div class="input-group">
                                 <div class="input-group-addon">
                                     <i class="fa fa-id-badge"></i>
                                 </div>
                                 <input class="form-control" type="number" min="1" wire:model="planUsers"
                                     id="planUsers">
                             </div>
                         </div>
                         @error('planUsers')
                             <span class="error text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                 </div>
                 <div class="col-md-4">
                     <div class="form-group row">
                         <label for="planCards" class="form-label">
                             {{ __('adding.plan.cards') }}
                         </label>
                         <div>
                             <div class="input-group">
                                 <div class="input-group-addon">
                                     <i class="fa fa-id-badge"></i>
                                 </div>
                                 <input class="form-control" type="number" min="1" wire:model="planCards"
                                     id="planCards">
                             </div>
                         </div>
                         @error('planCards')
                             <span class="error text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                 </div>
                 <div class="col-md-4">
                     <div class="form-group row">
                         <label for="planCharging" class="form-label">
                             {{ __('adding.plan.charging') }}
                         </label>
                         <div>
                             <div class="input-group">
                                 <div class="input-group-addon">
                                     <i class="fa fa-id-badge"></i>
                                 </div>
                                 <input class="form-control" type="number" min="1"
                                     wire:model="planCharging" id="planCharging">
                             </div>
                         </div>
                         @error('planCharging')
                             <span class="error text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                 </div>
                 <div class="col-md-4">
                     <div class="form-group row">
                         <label for="planOffers" class="form-label">
                             {{ __('adding.plan.offers') }}
                         </label>
                         <div>
                             <div class="input-group">
                                 <div class="input-group-addon">
                                     <i class="fa fa-id-badge"></i>
                                 </div>
                                 <input class="form-control" type="number" min="1" wire:model="planOffers"
                                     id="planOffers">
                             </div>
                         </div>
                         @error('planOffers')
                             <span class="error text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                 </div>
                 <div class="col-md-4">
                     <div class="form-group row">
                         <label for="cardDesgins" class="form-label">
                             {{ __('adding.plan.cardDesgins') }}
                         </label>
                         <div>
                             <div class="input-group">
                                 <div class="input-group-addon">
                                     <i class="fa fa-id-badge"></i>
                                 </div>
                                 <input class="form-control" type="number" min="1"
                                     wire:model="cardDesgins" id="cardDesgins">
                             </div>
                         </div>
                         @error('cardDesgins')
                             <span class="error text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                 </div>
             </div>
         </div>
     </div>
 @else
     <div class="row">
         <div class="col-12">
             <div class="row">
                 <div class="col-md-4 col-sm-12">
                     <div class="form-group row">
                         <label for="plan_id" class="form-label">
                             {{ __('adding.plan.name_ar') }}
                         </label>
                         <div>
                             <div class="input-group">
                                 <div class="input-group-addon">
                                     <i class="fa  fa-paper-plane"></i>
                                 </div>
                                 <input class="form-control text-white" type="text" wire:model="planNameAr">
                             </div>
                             @error('planName')
                                 <span class="error text-danger">{{ $message }}</span>
                             @enderror
                         </div>
                     </div>
                 </div>
                 <div class="col-md-4 col-sm-12">
                     <div class="form-group row">
                         <label for="plan_id" class="form-label">
                             {{ __('adding.plan.name_en') }}
                         </label>
                         <div>
                             <div class="input-group">
                                 <div class="input-group-addon">
                                     <i class="fa  fa-paper-plane"></i>
                                 </div>
                                 <input class="form-control text-white" type="text" wire:model="planNameEn">
                             </div>
                             @error('planName')
                                 <span class="error text-danger">{{ $message }}</span>
                             @enderror
                         </div>
                     </div>
                 </div>
                 {{-- col-md-4 --}}
                 <div class="col-md-4 col-sm-12">
                     <div class="form-group row">
                         <label for="plan_price" class="form-label">
                             {{ __('adding.plan.price') }}
                         </label>
                         <div>
                             <div class="input-group">
                                 <div class="input-group-addon">
                                     <i class="fa fa-map-o"></i>
                                 </div>
                                 <input class="form-control text-white" type="text" min="1"
                                     wire:model="planPrice">
                             </div>
                         </div>
                         @error('planPrice')
                             <span class="error text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                 </div>
                 <div class="col-md-4 col-sm-12">
                     <div class="form-group row">
                         <label for="plan_price" class="form-label">
                             {{ __('adding.plan.price_dollar') }}
                         </label>
                         <div>
                             <div class="input-group">
                                 <div class="input-group-addon">
                                     <i class="fa fa-map-o"></i>
                                 </div>
                                 <input class="form-control text-white" type="text" min="1"
                                     wire:model="planPriceDollar">
                             </div>
                         </div>
                         @error('planPrice')
                             <span class="error text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                 </div>
                 <div class="col-md-4">
                     <div class="form-group row">
                         <label for="planUsers" class="form-label">
                             {{ __('adding.plan.cafe_users') }}
                         </label>
                         <div>
                             <div class="input-group">
                                 <div class="input-group-addon">
                                     <i class="fa fa-id-badge"></i>
                                 </div>
                                 <input class="form-control" type="number" min="1"
                                     wire:model="planUsers" id="planUsers">
                             </div>
                         </div>
                         @error('planUsers')
                             <span class="error text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                 </div>
                 <div class="col-md-4">
                     <div class="form-group row">
                         <label for="planCards" class="form-label">
                             {{ __('adding.plan.cafe_cards') }}
                         </label>
                         <div>
                             <div class="input-group">
                                 <div class="input-group-addon">
                                     <i class="fa fa-id-badge"></i>
                                 </div>
                                 <input class="form-control" type="number" min="1"
                                     wire:model="planCards" id="planCards">
                             </div>
                         </div>
                         @error('planCards')
                             <span class="error text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                 </div>

                 <div class="col-md-4">
                     <div class="form-group row">
                         <label for="planOffers" class="form-label">
                             {{ __('adding.plan.offers') }}
                         </label>
                         <div>
                             <div class="input-group">
                                 <div class="input-group-addon">
                                     <i class="fa fa-id-badge"></i>
                                 </div>
                                 <input class="form-control" type="number" min="1"
                                     wire:model="planOffers" id="planOffers">
                             </div>
                         </div>
                         @error('planOffers')
                             <span class="error text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                 </div>
                 <div class="col-md-4">
                     <div class="form-group row">
                         <label for="cardDesgins" class="form-label">
                             {{ __('adding.plan.cardDesgins') }}
                         </label>
                         <div>
                             <div class="input-group">
                                 <div class="input-group-addon">
                                     <i class="fa fa-id-badge"></i>
                                 </div>
                                 <input class="form-control" type="number" min="1"
                                     wire:model="cardDesgins" id="cardDesgins">
                             </div>
                         </div>
                         @error('cardDesgins')
                             <span class="error text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                 </div>
             </div>
         </div>
     </div>
 @endif
