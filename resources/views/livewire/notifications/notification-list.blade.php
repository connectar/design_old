<li  class="dropdown notifications-menu" >
    <a href="#" class="waves-effect waves-light dropdown-toggle btn-primary-light"
        data-bs-toggle="dropdown" title="Notifications">
        @if($unread_notification_count )
        <div class="badge badge-danger badge-pill text-white text-center" style="width:20px;height: 20px;display:inline-flex; position:absolute;font-size:10px;top:0;right:0;z-index:2;">
          <p>
            {{ $unread_notification_count }}
          </p>
        </div>
        @endif
        <i class="fa fa-bell"></i>
    </a>
    <ul class="dropdown-menu animated bounceIn" style="width:250px;max-width:250px;" >

        <li class="header">
            <div class="p-20">
                <div class="flexbox ">
                    <div>
                        <h4 class="mb-0 mt-0">{{__('notification.notifications')}}</h4>
                    </div>
                    <!-- <div>
                        <a href="#" class="text-danger">{{__('notification.read_all')}}</a>
                    </div> -->
                </div>
            </div>
        </li>
        <li>
            <!-- inner menu: contains the actual data -->
            <ul class=" sm-scrol px-3" >
                            <!-- start TECH_SUPPORT_REPLY Notifications -->
              <div>
                @forelse($notifications as $notification)
                <div style="border-bottom:1px solid rgba(255,255,255,.4)">
                  <li  class="my-3 mx-1 px-0 " >
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
            </li>
          <li class="footer">
        <a href="{{$this->redirectToNotificationsRoute()}}">{{__('notification.view_all')}}</a>
      </li>
    </ul>
</li>
