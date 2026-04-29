
<div>
  <div class="card bg-light mb-3 px-4 mx-4 py-3 custom-margin-none"  style="word-break:break-all;">
    <div style="display:flex;justify-content:space-between;padding:5px;" >
      @if(authIsManager() || authIsSuperManager())
      <div style="display: flex;align-items: flex-end;border-bottom: 1px solid rgba(255, 255, 255, 0.2);" class="mb-2 custom-display-grid">
        <h3 class="badge badge-warning p-3 d-flex " style="font-size: 16px; padding: 9px 10px;">
          <div class="mx-2">
            <i class="fa fa-user-circle mr-2 " style="font-size:18px;" aria-hidden="true"></i>
            <span style="font-size: 18px;">{{ __('new_trans.ticket.user_name', ['name'=> $ticket->owner->fullname]) }}</span>
          </div>
            <span class="badge badge-dark">{{ '#' . $ticket->owner->name }}</span>
        </h3>
        <div class="p-2 mx-2" dir="ltr" style="font-size:14px;">
            {{ $ticket->created_at->diffForHumans() }}
        </div>
      </div>
      @endif

      <div class="custom-margin-top-goback-btn">
        <a href="{{route($this->redirectToTicketIndexRoute())}}" class="btn btn-danger btn-sm " >
          <i class="fa fa-arrow-left"></i>
          @if(authIsManager() || authIsSuperManager())
          <span class="custom-display-none">
            {{__('menu.tickets.tickets_received')}}
            <span>
          @else
          <span>
            {{__('menu.tickets.mytickets')}}
          </span>
          @endif
        </a>
      </div>
    </div>
      <div class="card-header custom-display-grid"  >
          <div class="">

            <div class="d-flex">
                <div >
                    <h4 class="text-primary ">
                            {{ trans('new_trans.ticket.ticket_title') }} :
                    </h4>
                </div>

            </div>
              <div class="d-flex custom-display-block" style="align-items:center;justify-content:center;">
                  <div>
                    <h5 class="text-white px-2 py-2 mx-2">
                        {{$ticket->title}}
                    </h5>
                    <div class="mx-2">
                      <div class="input-group mb-2 " style="align-items:center;">
                        <span class="badge badge-info" id="ticketNumber" style="font-size:13px;padding:9px 10px;">{{ $ticket->ticket_number }}</span>

                        <div class="input-group-append">
                          <button class="btn btn-secondary copy-button"  type="button" id="copyButton">
                            <i class="fa fa-copy"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
          </div>
          <div class="d-flex custom-display-grid-list">
            @if(authIsManager() || authIsSuperManager())
            <div class="px-1">
              <span class="badge badge-info ">
                  {{ __('new_trans.ticket.billing_code') . ' #'. $ticket->owner->getBillingcodeAttribute()}}
              </span>
            </div>
            @endif
              <div class="px-1">
                @if($ticket->status == App\ENUMS\TicketEnum::STATUS_OPEN)
                    <span class="badge badge-warning  ">
                        {{ __('new_trans.ticket.status.'. $ticket->status) }}
                    </span>
                @elseif($ticket->status == App\ENUMS\TicketEnum::STATUS_ARCHIVED)
                    <span class="badge badge-dark">
                        {{ __('new_trans.ticket.status.'. $ticket->status) }}
                    </span>
                @elseif($ticket->status == App\ENUMS\TicketEnum::STATUS_IN_PROGRESS)
                    <span class="badge badge-info">
                        {{ __('new_trans.ticket.status.'. $ticket->status) }}
                    </span>
                @elseif($ticket->status == App\ENUMS\TicketEnum::STATUS_PENDING)
                    <span class="badge badge-primary">
                        {{ __('new_trans.ticket.status.'. $ticket->status) }}
                    </span>
                @else
                    <span class="badge badge-danger">
                        {{ __('new_trans.ticket.status.'. $ticket->status) }}
                    </span>
                @endif
              </div>
              <div class="px-1">
                @if($ticket->type == App\ENUMS\TicketEnum::TYPE_TECH_SUPPORT)
                    <span class="badge badge-warning badge-pill ">
                        {{ __('new_trans.ticket.type.'. $ticket->type) }}
                    </span>
                @elseif($ticket->type == App\ENUMS\TicketEnum::TYPE_INQUIRY)
                    <span class="badge badge-dark badge-pill">
                        {{ __('new_trans.ticket.type.'. $ticket->type) }}
                    </span>
                @elseif($ticket->type == App\ENUMS\TicketEnum::TYPE_FEEDBACK)
                    <span class="badge badge-info badge-pill">
                        {{ __('new_trans.ticket.type.'. $ticket->type) }}
                    </span>
                @elseif($ticket->type == App\ENUMS\TicketEnum::TYPE_SUGGESTION)
                    <span class="badge badge-primary badge-pill">
                        {{ __('new_trans.ticket.type.'. $ticket->type) }}
                    </span>
                @else
                    <span class="badge badge-danger badge-pill">
                        {{ __('new_trans.ticket.type.'. $ticket->type) }}
                    </span>
                @endif
              </div>
              @if(authIsSuperManager() || authIsManager())
                  <div class="px-1">
                  @if($ticket->priority == App\ENUMS\TicketEnum::PRIORITY_LOW)
                      <span class="badge badge-warning  ">
                          {{ __('new_trans.ticket.priority.'. $ticket->priority) }}
                      </span>
                  @elseif($ticket->priority == App\ENUMS\TicketEnum::PRIORITY_MEDIUM)
                      <span class="badge badge-dark">
                          {{ __('new_trans.ticket.priority.'. $ticket->priority) }}
                      </span>
                  @elseif($ticket->priority == App\ENUMS\TicketEnum::PRIORITY_HIGH)
                      <span class="badge badge-info">
                          {{ __('new_trans.ticket.priority.'. $ticket->priority) }}
                      </span>
                  @elseif($ticket->priority == App\ENUMS\TicketEnum::PRIORITY_URGENT)
                      <span class="badge badge-primary">
                          {{ __('new_trans.ticket.priority.'. $ticket->priority) }}
                      </span>
                  @else
                      <span class="badge badge-danger">
                          {{ __('new_trans.ticket.priority.'. $ticket->priority) }}
                      </span>
                  @endif
                </div>
              @endif
              <div class="px-1">
                  @if($ticket->is_resolved)
                      <span class="badge badge-success ">
                          {{ trans('new_trans.ticket.is_resolved.true') }}
                      </span>
                      @else
                      <span class="badge badge-danger ">
                          {{ trans('new_trans.ticket.is_resolved.false') }}
                      </span>
                  @endif
              </div>

          </div>
      </div>
      <div class="card-body" >
          <div class="p-2  ">
              <h5 class="text-primary">
                  {{ trans('new_trans.ticket.ticket_description') }} :
              </h5>
              <p class="card-text px-4 py-2 custom-padding-none">{{$ticket->description}}</p>
          </div>
      </div>
    </div>


</div>

@push('styles')
  <style>
    .copy-button {
        padding: 5px 10px;
        font-size: 15px;
        border: 1px solid #ccc;
        background-color: #fff;
        cursor: pointer;
    }

    .copy-button:hover {
        background-color: #eee;
    }

    .del-danger {
      color: rgba(255, 255, 255, 0.8) !important;
    }

    .del-danger:hover {
      color: #e3342f !important;
    }

    .del-danger.clicked {
      color: #e3342f !important;
    }
    @media (max-width: 768px) {
      .custom-display-grid
      {
      	display:grid;
      }
     .custom-display-block
      {
      	display:block!important;
      }
      .custom-display-none
       {
         display:none!important;
       }
       .custom-margin-top-goback-btn{
         margin-top:20px;
       }
      .custom-margin-none {
        margin: 4px!important;
      }
      .custom-padding-none {
        padding:0px!important;
      }
      .custom-display-grid-list{
        display: grid!important;
        grid-template-columns:1fr 1fr 1fr;
        grid-row-gap:5px;
      }
    }
  </style>
  @endpush
  @push('scripts')
  <script>
    document.getElementById("copyButton").addEventListener("click", function() {
        // Get the text from the badge
        var ticketNumber = document.getElementById("ticketNumber").textContent;

        // Create a temporary input element and append it to the body
        var tempInput = document.createElement("input");
        tempInput.value = ticketNumber;
        document.body.appendChild(tempInput);

        // Select the text in the input element
        tempInput.select();
        tempInput.setSelectionRange(0, 99999); // For mobile devices

        // Copy the selected text to the clipboard
        document.execCommand("copy");

        // Remove the temporary input element
        document.body.removeChild(tempInput);

        // Change the icon to indicate successful copy
        var copyButton = document.getElementById("copyButton");
        copyButton.innerHTML = '<i class="fa fa-check"></i>';
        setTimeout(function() {
            copyButton.innerHTML = '<i class="fa fa-copy"></i>';
        }, 3000); // Change back to the copy icon after 1 second

    });
  </script>

  @endpush
