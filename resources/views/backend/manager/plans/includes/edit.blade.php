 @if ($plan->type == App\ENUMS\PlanTypeEnum::TYPE_NETWORK)
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
                                 <input class="form-control text-white" type="text" name="planNameAr"
                                     value="{{ $plan->name_ar }}">
                             </div>
                         </div>
                     </div>
                     @error('planNameAr')
                     <span class="error text-danger">{{ $message }}</span>
                    @enderror
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
                                <input class="form-control text-white" type="text" name="planNameEn"
                                    value="{{ $plan->name_en }}">
                            </div>
                        </div>
                    </div>
                    @error('planNameEn')
                    <span class="error text-danger">{{ $message }}</span>
                   @enderror
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
                                     name="price" value="{{ $plan->price }}">
                             </div>
                         </div>
                     </div>
                     @error('price')
                     <span class="error text-danger">{{ $message }}</span>
                    @enderror
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
                                    name="price_dollar" value="{{ $plan->price_dollar }}">
                            </div>
                        </div>
                    </div>
                    @error('price_dollar')
                    <span class="error text-danger">{{ $message }}</span>
                   @enderror
                </div>
                 <div class="col-md-4">
                     <div class="form-group row">
                         <label for="users" class="form-label">
                             {{ __('adding.plan.users') }}
                         </label>
                         <div>
                             <div class="input-group">
                                 <div class="input-group-addon">
                                     <i class="fa fa-id-badge"></i>
                                 </div>
                                 <input class="form-control" type="number" min="1" name="users"
                                     id="users" value="{{ $plan->users }}">
                             </div>
                         </div>
                     </div>
                     @error('users')
                     <span class="error text-danger">{{ $message }}</span>
                    @enderror
                 </div>
                 <div class="col-md-4">
                     <div class="form-group row">
                         <label for="cards" class="form-label">
                             {{ __('adding.plan.cards') }}
                         </label>
                         <div>
                             <div class="input-group">
                                 <div class="input-group-addon">
                                     <i class="fa fa-id-badge"></i>
                                 </div>
                                 <input class="form-control" type="number" min="1" name="cards"
                                     id="cards" value="{{ $plan->cards }}">
                             </div>
                         </div>
                     </div>
                     @error('cards')
                     <span class="error text-danger">{{ $message }}</span>
                    @enderror
                 </div>
                 <div class="col-md-4">
                     <div class="form-group row">
                         <label for="charging" class="form-label">
                             {{ __('adding.plan.charging') }}
                         </label>
                         <div>
                             <div class="input-group">
                                 <div class="input-group-addon">
                                     <i class="fa fa-id-badge"></i>
                                 </div>
                                 <input class="form-control" type="number" min="1" name="charging"
                                     id="charging" value="{{ $plan->charging }}">
                             </div>
                         </div>
                     </div>
                     @error('charging')
                     <span class="error text-danger">{{ $message }}</span>
                    @enderror
                 </div>
                 <div class="col-md-4">
                     <div class="form-group row">
                         <label for="offers" class="form-label">
                             {{ __('adding.plan.offers') }}
                         </label>
                         <div>
                             <div class="input-group">
                                 <div class="input-group-addon">
                                     <i class="fa fa-id-badge"></i>
                                 </div>
                                 <input class="form-control" type="number" min="1" name="offers"
                                     id="offers" value="{{ $plan->offers }}">
                             </div>
                         </div>
                     </div>
                     @error('offers')
                     <span class="error text-danger">{{ $message }}</span>
                    @enderror
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
                                     name="card_desgins" id="cardDesgins"
                                     value="{{ $plan->card_desgins }}">
                             </div>
                         </div>
                     </div>
                     @error('cardDesigns')
                     <span class="error text-danger">{{ $message }}</span>
                    @enderror
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
                             {{ __('adding.plan.name') }}
                         </label>
                         <div>
                             <div class="input-group">
                                 <div class="input-group-addon">
                                     <i class="fa  fa-paper-plane"></i>
                                 </div>
                                 <input class="form-control text-white" type="text" name="name"
                                     value="{{ $plan->name }}">
                             </div>
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
                                     name="price" value="{{ $plan->price }}">
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-4">
                     <div class="form-group row">
                         <label for="users" class="form-label">
                             {{ __('adding.plan.cafe_users') }}
                         </label>
                         <div>
                             <div class="input-group">
                                 <div class="input-group-addon">
                                     <i class="fa fa-id-badge"></i>
                                 </div>
                                 <input class="form-control" type="number" min="1" name="users"
                                     id="users" value="{{ $plan->users }}">
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-4">
                     <div class="form-group row">
                         <label for="cards" class="form-label">
                             {{ __('adding.plan.cafe_cards') }}
                         </label>
                         <div>
                             <div class="input-group">
                                 <div class="input-group-addon">
                                     <i class="fa fa-id-badge"></i>
                                 </div>
                                 <input class="form-control" type="number" min="1" name="cards"
                                     id="cards" value="{{ $plan->cards }}">
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-4">
                     <div class="form-group row">
                         <label for="offers" class="form-label">
                             {{ __('adding.plan.offers') }}
                         </label>
                         <div>
                             <div class="input-group">
                                 <div class="input-group-addon">
                                     <i class="fa fa-id-badge"></i>
                                 </div>
                                 <input class="form-control" type="number" min="1" name="offers"
                                     id="offers" value="{{ $plan->offers }}">
                                 <input type="hidden" name="charging"
                                     value="{{ $plan->charging }}">
                             </div>
                         </div>
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
                                     name="card_desgins" id="cardDesgins"
                                     value="{{ $plan->card_desgins }}">
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 @endif
