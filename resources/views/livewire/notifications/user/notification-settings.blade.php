


<div class="box">



  <div class="box-header with-border">
    <h3 class="box-title text-primary">
      <i class="fa fa-bell fa-fw fa-beat" ></i>
      {{ __('menu.user_menu.notification_settings') }}
    </h3>
  </div>
  <div class="box-body res-tb-block">
    <div class="row mt-4">
      <h3 class="px-4 py-3 text-primary">
        <i class="fa fa-telegram px-2  fa-fw fa-beat-fade" ></i>
        <span class="px-2">
          التليجرام
        </span>
      </h3>
      <div wire:poll.5s class="col-md-10 d-flex mx-auto align-items-center my-4 pb-4 custom-grid-mobile ">
        <div class="col-md-9">
            <div class="mb-3 col-md-10 ">
                <label for="telegramNotifications" class="form-label">
                  @if($telegram_chat_id == null)
                  <h4 class=" text-danger">
                    <i class="fa fa-telegram  fa-fw fa-beat-fade" ></i>
                    <span class="px-2">
                    ربط التليجرام
                  </span>
                      (غير مربوط)
                  </h4>
                  @else
                    <h4 class=" text-success">
                      <i class="fa fa-telegram  fa-fw fa-beat-fade" ></i>
                      <span class="px-2">
                      ربط التليجرام
                    </span>
                        (مربوط)
                    </h4>
                  @endif
                </label>
                <h6 class="p-1 " style="line-height:1.7;">
                  يجب عليك ربط حساب التليجرام الخاص بك بالنظام حتي تستطيع استقبال الاشعارات علي التليجرام
                </h6>
            </div>
        </div>
        <div class="col-sm-3 text-center  mb-20">
          <div class="d-flex justify-content-center">
            @if($telegram_chat_id == null)
            <a href="{{route('telegram-temp-url')}}" target="_blank" class="btn btn-success"> ربط التليجرام</a>
            @else
            <button wire:click="disable()"  wire:loading.attr="disabled"  class="btn btn-danger">الغاء ربط التليجرام</a>
            @endif
          </div>
        </div>
      </div>


        <div class="col-md-10 d-flex mx-auto align-items-center my-4 pb-4 custom-grid-mobile">
          <div class="col-md-9">
              <div class="mb-3 col-md-10">
                  <label for="telegramNotifications" class="form-label">
                    @if($this->telegramNotifications)
                        <h4 class=" text-success">
                          <i class="fa fa-telegram  fa-fw fa-beat-fade" ></i>
                          <span class="px-2">
                          اشعارات التليجرام
                        </span>
                            (فعالة)
                        </h4>
                      @else
                        <h4 class=" text-danger">
                          <i class="fa fa-telegram  fa-fw fa-beat-fade" ></i>
                          <span class="px-2">
                          اشعارات التليجرام
                        </span>
                            (معطلة)
                        </h4>
                      @endif
                    </label>
                  <h6 class="p-1 " style="line-height:1.7;">
                    تفعيل جميع اشعارات التليجرام يمكنك من استقبال اشعارات وتحديثات حول استهلاكك ومعلومات اخري ومتابعة اخر الاشعارات
                  </h6>
              </div>
          </div>
          @if($this->telegramNotifications)
          <div class="col-sm-3 text-center  mb-20">
            <button type="button" class="btn btn-lg btn-toggle active"  wire:click="toggleAllTelegramNotifications()" wire:loading.attr="disabled" data-bs-toggle="button" aria-pressed="true" autocomplete="off">
              <div class="handle"></div>
            </button>
          </div>
        @else
        <div class="col-sm-3 text-center  mb-20">
          <button type="button" class="btn btn-lg btn-toggle "  wire:click="toggleAllTelegramNotifications()" wire:loading.attr="disabled" data-bs-toggle="button" aria-pressed="false" autocomplete="off">
            <div class="handle"></div>
          </button>
        </div>
        @endif
      </div>

    </div>

</div>
