 <div class="row">
     <div class="col-12">
         <div class="row">
             <div class="col-md-4 col-sm-12">
                 <div class="form-group row">
                     <label for="plan_id" class="form-label">
                         {{ __('adding.register.plan_name') }}
                     </label>
                     <div>
                         <div class="input-group">
                             <div class="input-group-addon">
                                 <i class="fa  fa-paper-plane"></i>
                             </div>
                             <input class="form-control text-white" type="text"
                                 value="{{ $selectedPlanName }}" readonly>
                         </div>
                     </div>
                 </div>
             </div>
             {{-- col-md-4 --}}
             <div class="col-md-4 col-sm-12">
                 <div class="form-group row">
                     <label for="country_id" class="form-label">
                         {{ __('adding.register.country') }}
                     </label>
                     <div>
                         <div class="input-group">
                             <div class="input-group-addon">
                                 <i class="fa fa-map-o"></i>
                             </div>
                             <select class="form-select" wire:model="country_id">
                                 @foreach ($countries as $country)
                                     <option value="{{ $country['id'] }}">
                                         {{ $country['name'] }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                 </div>
             </div>
             {{-- col-md-4 --}}
             @if ($governorates)
                 <div class="col-md-4 col-sm-12" id="governorates">
                     <div class="form-group row">
                         <label for="governorate_id" class="form-label">
                             {{ __('adding.register.governorate') }}
                         </label>
                         <div>
                             <div class="input-group">
                                 <div class="input-group-addon">
                                     <i class="fa fa-road"></i>
                                 </div>
                                 <select class="form-select" wire:model="governorate_id"
                                     id="governorate_id">
                                     @foreach ($governorates as $governorate)
                                         <option value="{{ $governorate['id'] }}">
                                             {{ $governorate['name'] }}
                                         </option>
                                     @endforeach
                                 </select>
                             </div>
                         </div>
                     </div>
                 </div>
             @endif
         </div>
         <div class="row">
             {{-- col-md-4 --}}
             <div class="col-md-4">
                 <div class="form-group row">
                     <label for="network_name" class="form-label">
                         {{ __('adding.register.network_name') }}
                     </label>
                     <div>
                         <div class="input-group">
                             <div class="input-group-addon">
                                 <i class="fa fa-id-badge"></i>
                             </div>
                             <input class="form-control" type="text"
                                 wire:model="networkName" id="network_name">
                         </div>
                     </div>
                     @error('networkName')
                         <span class="error text-danger">{{ $message }}</span>
                     @enderror
                 </div>
             </div>
             <div class="col-md-4">
                 <div class="form-group row">
                     <label for="name" class="form-label">
                         {{ __('adding.nas.type') }}
                     </label>
                     <div>
                         <div class="input-group">
                             <div class="input-group-addon">
                                 <i class="fa fa-tags text-primary"></i>
                             </div>

                             <select class="form-select" wire:model="nasType">
                                 @foreach (trans('adding.nas.types') as $key => $value)
                                     )
                                     <option value="{{ $key }}">
                                         {{ $value }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                     @error('nasType')
                         <span class="error text-danger">{{ $message }}</span>
                     @enderror
                 </div>
             </div>
             {{-- col-md-4 --}}
             <div class="col-md-4">
                 <div class="form-group row">
                     <label for="admin_name" class="form-label">
                         {{ __('adding.register.admin_name') }}
                     </label>
                     <div>
                         <div class="input-group">
                             <div class="input-group-addon">
                                 <i class="fa fa-id-badge"></i>
                             </div>
                             <input class="form-control" type="text"
                                 wire:model="adminFullName" id="admin_name">
                         </div>
                     </div>
                     @error('adminFullName')
                         <span class="error text-danger">{{ $message }}</span>
                     @enderror
                 </div>
             </div>

             <div class="col-md-4">
                 <div class="form-group row">
                     <label for="admin_username" class="form-label">
                         {{ __('adding.register.admin_username') }}
                     </label>
                     <div>
                         <div class="input-group">
                             <div class="input-group-addon">
                                 <i class="fa fa-user"></i>
                             </div>
                             <input class="form-control" type="text" wire:model="adminName"
                                 id="admin_username">
                         </div>
                     </div>
                     @error('adminName')
                         <span class="error text-danger">{{ $message }}</span>
                     @enderror
                 </div>
             </div>
             <div class="col-md-4">
                 <div class="form-group row">
                     <label for="admin_password" class="form-label">
                         {{ __('adding.register.admin_password') }}
                     </label>
                     <div>
                         <div class="input-group">
                             <div class="input-group-addon">
                                 <i class="fa fa-key"></i>
                             </div>
                             <input class="form-control" type="text"
                                 wire:model="adminPassword" id="admin_password">
                         </div>
                     </div>
                     @error('adminPassword')
                         <span class="error text-danger">{{ $message }}</span>
                     @enderror
                 </div>
             </div>
             <div class="col-md-4">
                 <div class="form-group row">
                     <label for="password_confirmation" class="form-label">
                         {{ __('adding.register.admin_password2') }}
                     </label>
                     <div>
                         <div class="input-group">
                             <div class="input-group-addon">
                                 <i class="fa fa-key"></i>
                             </div>
                             <input class="form-control" type="text"
                                 wire:model="password_confirmation"
                                 id="password_confirmation">
                         </div>
                     </div>
                     @error('password_confirmation')
                         <span class="error text-danger">{{ $message }}</span>
                     @enderror
                 </div>
             </div>
         </div>

         <div class="row">
             <div class="col-md-4">
                 <div class="form-group row">
                     <label for="admin_phone" class="form-label">
                         {{ __('adding.register.admin_phone') }}
                     </label>
                     <div>
                         <div class="input-group">
                             <div class="input-group-addon">
                                 <i class="fa fa-phone"></i>
                             </div>
                             <input class="form-control" type="text"
                                 wire:model="adminPhone" id="admin_phone">
                         </div>
                     </div>
                     @error('adminPhone')
                         <span class="error text-danger">{{ $message }}</span>
                     @enderror
                 </div>
             </div>
             <div class="col-md-4">
                 <div class="form-group row">
                     <label for="admin_phone_other" class="form-label">
                         {{ __('adding.register.admin_phone_other') }}
                     </label>
                     <div>
                         <div class="input-group">
                             <div class="input-group-addon">
                                 <i class="fa fa-phone"></i>
                             </div>
                             <input class="form-control" type="text"
                                 wire:model="other_phone" id="admin_phone_other">
                         </div>
                     </div>
                     @error('other_phone')
                         <span class="error text-danger">{{ $message }}</span>
                     @enderror
                 </div>
             </div>
         </div>
     </div>
 </div>
