


<div wire:ignore.self wire:key="modal-message-info-{{$model->id}}"  class="modal fade" id="bs-info-modal-lg_{{$model->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;padding-right:0px!important;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-white">
        {{__('new_trans.admin_messages.info_modal.title')}}
      </h4>
        <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-danger py-1 px-2" style="height:50%;">
          <i class="fa fa-times fa-x"></i>
        </button>
      </div>
      <div class="modal-body p-2" style="word-break: break-all; overflow-wrap: break-word;">
        <div class="container">
          <div class="row">
           <div style="display:grid;grid-template-columns:6fr 18fr;">

              <div class="text-xl text-white p-2 my-2 ">
                {{__('new_trans.admin_messages.message')}}
              </div>
              <div class="p-2" style="word-break: break-all!important; overflow-wrap: break-word!important;">
                {{ $model->message }}
             </div>

              <div class="text-xl text-white p-2 ">
                {{__('new_trans.expenses.nas')}}
              </div>
              <div class="p-2 my-2">
                  <span class="badge badge-info mx-1">
                    {{ $model->nas->name ?? __('new_trans.admin_messages.all_nas') }}
                  </span>
             </div>

            <div class="text-xl text-white p-2 ">
                {{__('new_trans.admin_messages.channels.channel')}}
              </div>
              <div class="p-2 my-2">
                @if($model->channel == App\ENUMS\AdminMessageEnum::CHANNEL_APP)
                  <span class="badge badge-light mx-1" style="color:#1f1f1f!important;">
                    {{ __('new_trans.admin_messages.channels.app') }}
                  </span>
                @elseif($model->channel == App\ENUMS\AdminMessageEnum::CHANNEL_TELEGRAM)
                  <span class="badge badge-light  mx-1" style="color:#1f1f1f!important;">
                    {{ __('new_trans.admin_messages.channels.telegram') }}
                  </span>
                  @else
                  <span class="badge badge-light mx-1" style="color:#1f1f1f!important;">
                    {{ __('new_trans.admin_messages.channels.all') }}
                  </span>
                @endif
             </div>
             <div class="text-xl text-white p-2 ">
                {{__('new_trans.admin_messages.send_to')}}
              </div>
              <div class="p-2 my-2">
                  {{ App\ENUMS\AdminMessageEnum::filterMessages($model->filter)}}
              </div>
              <div class="text-xl text-white p-2 ">
                {{__('new_trans.created_at')}}
              </div>
              <div class="p-2 my-2">
                  {{ $model->created_at->format('Y-m-d H:i') . ' - ('. $model->created_at->diffForHumans() .')'  }}
              </div>

              <div class="text-xl text-white p-2 ">
                {{__('new_trans.updated_at')}}
              </div>
              <div class="p-2 my-2">
                  {{ $model->updated_at->format('Y-m-d H:i') . ' - ('. $model->updated_at->diffForHumans() .')' }}
              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-end">
        <button type="button" data-action="closePaymentModal" class="btn btn-danger text-start" data-bs-dismiss="modal">{{__('new_trans.close')}}</button>
      </div>
    </div>
  </div>
</div>