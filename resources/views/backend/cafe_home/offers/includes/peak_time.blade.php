 <div class="col-md-2">
     <div class="form-group row">
         <label for="enable_peak_time" class="form-label">
             {{ __('adding.offer.enable_peak_time') }}
         </label>
         <div class="col-sm-9">
             <label class="switch switch-success">
                 <input type="checkbox" name="peak_time" x-model="peak_time" x-bind:checked="peak_time == 1" />
                 <span class="switch-indicator"></span>
             </label>
         </div>
     </div>
 </div>
 <div class="col-md-6" x-show="peak_time">
     <x-offer-speed name="peak_time_speed" speed-title="{{ __('adding.offer.speed_in_pick_time') }}"
         x-model="offer.peak_time_details.speed" :class="null" />
 </div>
 {{-- peak time duration --}}
 <div class="col-md-4" x-show="peak_time">
     <div class="row">
         <div class="col-6">
             <div class="form-group row">
                 <label for="after_expired_quta" class="form-label text-success">
                     @lang('adding.offer.time_from')
                 </label>
                 <div>
                     <div class="input-group bootstrap-timepicker">
                         <div class="input-group-addon">
                             <i class="fa fa-clock-o text-success"></i>
                         </div>
                         <input class="form-control timepicker" type="text" name="peak_time_start"
                             x-model="offer.peak_time_details.start" />
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-6">
             <div class="form-group row">
                 <label for="after_expired_quta" class="form-label text-danger">
                     @lang('adding.offer.time_to')
                 </label>
                 <div>
                     <div class="input-group bootstrap-timepicker">
                         <div class="input-group-addon">
                             <i class="fa fa-clock-o text-danger"></i>
                         </div>
                         <input class="form-control timepicker" type="text" name="peak_time_end"
                             x-model="offer.peak_time_details.end" />
                     </div>
                 </div>
             </div>
         </div>
     </div>
     {{-- peak time duration --}}
 </div>
