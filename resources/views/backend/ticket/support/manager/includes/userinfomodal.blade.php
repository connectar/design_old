<div>
  <div  class="modal fade show" style="display:block;position:fixed!important;" >
    <div class="modal-dialog " style="max-width:40%!important;" >
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title px-3 ">
            {{__('new_trans.ticket.user_info_modal.index')}}
          </h3>
          <div >
            <button wire:loading.attr="disabled" href="#" class="btn btn-danger py-1 px-2 " style="height:50%;" wire:click="hideModal">
              <i class="fa fa-times fa-x"></i>
            </button>
          </div>
        </div>
        <div class="modal-body px-4 mx-4" style="text-align:right;">
          <!-- User Info -->
          <div class="row my-4">
            <div class="col-md-4">
              <h4>{{__('new_trans.ticket.user_info_modal.user_name') }} :</h4>
            </div>
            <div class="col-md-8">
              <h4>{{ $model->owner->name }}</h4>
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-md-4">
              <h4>{{__('new_trans.ticket.user_info_modal.fullname')}} :</h4>
            </div>
            <div class="col-md-8">
              <h4>{{ $model->owner->fullname }}</h4>
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-md-4">
              <h4>{{__('new_trans.admin_type')}} :</h4>
            </div>
            <div class="col-md-8">
              <h4>
                @if(in_array($model->owner->type, [App\ENUMS\AdminTypeEnum::TYPE_SUPER_ADMIN, App\ENUMS\AdminTypeEnum::TYPE_ADMIN]))
                <span class="badge badge-warning  ">
                  {{ __('new_trans.admin_types.'. $model->owner->type) }}
                </span>
                @elseif(in_array($model->owner->type, [App\ENUMS\AdminTypeEnum::TYPE_CAFE_ADMIN, App\ENUMS\AdminTypeEnum::TYPE_CAFE_BRANCH_ADMIN]))
                <span class="badge badge-success">
                  {{ __('new_trans.admin_types.'. $model->owner->type) }}
                </span>
                @elseif($model->owner->type == App\ENUMS\AdminTypeEnum::TYPE_DISTRIBUTOR)
                <span class="badge badge-info">
                  {{ __('new_trans.admin_types.'. $model->owner->type) }}
                </span>
                @elseif($model->owner->type == App\ENUMS\AdminTypeEnum::TYPE_CAFE_HOME)
                <span class="badge badge-primary">
                  {{ __('new_trans.admin_types.'. $model->owner->type) }}
                </span>
                @else
                <span class="badge badge-danger">
                  {{ __('new_trans.admin_types.'. $model->owner->type) }}
                </span>
                @endif
              </h4>
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-md-4">
              <h4>{{__('new_trans.ticket.user_info_modal.network_name')}} :</h4>
            </div>
            <div class="col-md-8">
              <h4>{{ $model->owner->network->name }}</h4>
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-md-4">
              <h4>{{__('new_trans.ticket.user_info_modal.ticket_number')}} :</h4>
            </div>
            <div class="col-md-8">
              <h4>{{ $model->ticket_number }}</h4>
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-md-4">
              <h4>{{__('new_trans.ticket.user_info_modal.billing_code')}} :</h4>
            </div>
            <div class="col-md-8">
              <h4>{{ $billing_code }}</h4>
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-md-4">
              <h4>{{__('new_trans.ticket.user_info_modal.phone')}} :</h4>
            </div>
            <div class="col-md-8">
              <h4>{{ $model->owner->phone }}</h4>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" wire:loading.attr="disabled" class="btn btn-danger" data-dismiss="modal" wire:click="hideModal">
            {{__('new_trans.close')}}
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Backdrop -->
  <div class="modal-backdrop fade show" style="z-index: -1;"></div>
  <!-- End Modal -->
<!-- /Users Info Modal -->
</div>
