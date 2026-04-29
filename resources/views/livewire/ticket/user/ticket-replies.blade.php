<div class="card text-white bg-dark mb-3" >
  <div class=" card-header">
    <div>
      <h4 class=" text-primary">{{__('new_trans.ticket.replies.index')}}</h4>
    </div>
    @if(authIsSuperManager() || authIsManager())

    <div class="d-flex justify-content-end ">
    @if($ticket->status == App\ENUMS\TicketEnum::STATUS_CLOSED)
    <button type="button"  class="btn btn-danger mx-3  rounded" wire:loading.attr="disabled" wire:click="markStatus(1)">
      <i class="fa fa-times fa-lg"></i>
      فتح التذكرة
      <span wire:loading  class="px-3">
        <i class="fa fa-spinner fa-spin fa-lg"></i>
      </span>
    </button>
    @else
    <button type="button"  class="btn btn-success mx-3 rounded " wire:loading.attr="disabled"  wire:click="markStatus(0)">
      <i class="fa fa-check fa-lg"></i>
      غلق التذكرة
      <span wire:loading class="px-3">
        <i class="fa fa-spinner fa-spin fa-lg"></i>
      </span>
    </button>
    @endif
  </div>
  @endif
</div>
  @forelse($replies as $reply)
    <div class="card-body custom-margin-mobile" style="border-bottom:1px solid rgba(255, 255, 255, .4);
     background-color:#0e1e3a;color:rgba(255,255,255,.8);border-radius:10px;margin:10px 40px 30px 40px;padding:20px;" >
      <div style="display:flex;justify-content:space-between;" class="custom-display-grid">
        <div>
          <span class=" badge badge-danger  px-4 d-inline-flex py-2 items-center ">
              <!-- <i class="fa fa-headphones px-2 " style="font-size:25px;"></i> -->
              <img src="{{asset('images/ticket-customer-service.png')}}" width="30px" />
              <h5 class="mt-1 px-1 ">{{authIsSuperManager() || authIsManager() ? __('new_trans.ticket.replies.tech_support') . " #".$reply->owner->name : __('new_trans.ticket.replies.tech_support') }}</h5>
          </span>
        </div>
        @if(authIsSuperManager() || authIsManager())
          <div class="d-inline-flex items-center   m-2 fw-lg">
            <span class=" ">
              {{ $reply->created_at->diffForHumans()}}
            </span>
            <div :wire:key="'ticket_reply_'.$reply->id" class="mx-4">
              <a href="#"  wire:click.prevent="showDeletedBox({{ $reply->id }})" class="del-danger  p-1 text-md">
                <i class="fa fa-trash fa-2x"></i>
              </a>
            </div>
            </div>
            @else
            <div class="p-2  fw-lg">
              <span class="">
                {{ $reply->created_at->diffForHumans()}}
              </span>
            </div>
        @endif

      </div>
      <div style="" class="p-4 custom-padding-mobile">
          <p class="card-text">{{$reply->message}}</p>
      </div>
    </div>
  @empty
    <div class="card-body">
        <h5 class="card-title text-white">{{__('new_trans.ticket.no_replies_yet.title')}}</h5>
        <p class="card-text">
            {{__('new_trans.ticket.no_replies_yet.message')}}
        </p>
    </div>
  @endforelse
  <style>
  @media (max-width: 768px) {
    .custom-display-grid
    {
      display:grid!important;
    }
    .custom-padding-mobile
    {
      padding:2px!important;
    }

    .custom-margin-mobile
    {
      margin:4px!important;
    }

  }
</style>
</div>
