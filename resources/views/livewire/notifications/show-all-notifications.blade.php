<div class="p-4 my-4" style="border:2px solid rgba(255,255,255,.2);border-radius:1%;">
  <div class="my-4 pb-4">
    <h1>
         {{__('notification.latest_notifications')}}
    </h1>
  </div>
      <!-- inner menu: contains the actual data -->
      <ul class="  px-3 mx-4" >
                      <!-- start TECH_SUPPORT_REPLY Notifications -->
        <div>
          @forelse($notifications as $notification)
          <div style="border-bottom:1px solid rgba(255,255,255,.4)">
            <li  class="my-3 mx-1 px-0 " style="list-style:none;" >
              @php
                $notification_id = $notification->id;
                $route = $notification->route;
                $model_id = $notification->data['model_id'];
              @endphp
              <a  wire:key="{{$notification->id}}"
                wire:click='markAsReadNotification("{{$notification_id}}","{{$route}}","{{$model_id}}")' href="#" style="word-break:default;" >
                <div style="display:flex;align-items:center;">
                  <div>
                      <i class="{{ $notification->data['icon'] ?? ''}}   fa-2x m-2 p-2"></i>
                  </div>
                  <div >
                     {{ $notification->data['message'] }}
                      [  {{ $notification->data['reply'] ?? 'مشاهدة المزيد' }} ]
                      <i class="fa fa-check-circle p-2 {{ empty($notification->read_at) ?  '' : 'text-primary' }}" ></i>
                      <div class="">
                      {{$notification->created_at->diffForHumans()}}
                    </div>
                   </div>
                 </div>
                </a>
            </li>
          </div>
            @empty
            <li class="text-light my-4  text-center " style="list-style:none;">
              {{ __('notification.no_notifications')}}
            </li>
            @endforelse
        </div>

        <!-- end TECH_SUPPORT_REPLY Notifications -->
        </ul>
    </div>
