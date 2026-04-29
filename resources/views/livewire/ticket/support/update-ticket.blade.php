
<div>
<div class="card bg-light mb-3 px-4 mx-4 py-3"  style="word-break:break-all;">
  <div style="padding:5px;width:100%" >
    <div style="display:inline;">
    <a href="{{route($this->redirectToTicketIndexRoute())}}" class="btn btn-danger btn-sm " >
      <i class="fa fa-arrow-left"></i>
      @if(authIsManager() || authIsSuperManager())
        {{__('menu.tickets.tickets_received')}}
      @else
        {{__('menu.tickets.mytickets')}}
      @endif
    </a>
  </div>
  </div>
<form wire:submit="update" method="post" >
              <div class="row" style="padding:25px;">
                <div class="col-6">
                  <div class="form-group row">
                    <label for="title" class="col-form-label">
                    {{ trans('new_trans.ticket.username') }}
                    </label>
                  <div>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-tags text-success"></i>
                    </div>
                      <input class="form-control" style="color:#5d657a" id='title' type="text" disabled wire:model.lazy="user_name" >
                  </div>
                    @error('title')
                    <span class="error text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                  </div>
                </div>
                  <div class="col-6">
                    <div class="form-group row">
                      <label for="title" class="col-form-label">
                      {{ trans('new_trans.ticket.billing_code') }}
                      </label>
                    <div>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-tags text-success"></i>
                      </div>
                        <input class="form-control" style="color:#5d657a" id='title' type="text" disabled wire:model.lazy="billing_code" >
                    </div>
                      @error('title')
                      <span class="error text-danger">{{ $message }}</span>
                      @enderror
                      </div>
                    </div>
                  </div>

                <div class="col-8">
                  <div class="form-group row">
                    <label for="title" class="col-form-label">
                    {{ trans('new_trans.ticket.ticket_title') }}
                    </label>
                  <div>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-tags text-success"></i>
                    </div>
                      <input class="form-control" style="color:#5d657a" id='title' type="text" disabled wire:model.lazy="title" >
                  </div>
                    @error('title')
                    <span class="error text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group row">
                      <label for="type" class="form-label">
                          {{ trans('new_trans.ticket.ticket_type') }}
                      </label>
                      <div>
                          <div class="input-group p-0">
                              <div class="input-group-addon">
                                  <i class="fa fa-flash text-danger"></i>
                              </div>
                                  <select class="form-select" disabled id="type" wire:model.prevent="type" >
                                      @foreach (App\ENUMS\TicketEnum::getLabelTicketTypes() as $key => $name)
                                          <option value="{{ $key }}">
                                              {{ $name }}
                                          </option>
                                      @endforeach
                                  </select>
                          </div>
                          @error('type')
                            <span class="error text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>

                  {{-- col-md-4 --}}
                  <div class="col-12">
                      <div class="form-group row">
                          <label for="description" class="col-form-label">
                              {{ trans('new_trans.ticket.ticket_description') }}
                          </label>
                          <div>
                              <div class="input-group">
                                  <div class="input-group-addon">
                                      <i class="fa fa-bookmark text-primary"></i>
                                  </div>
                                  <textarea class="form-control" style="color:#5d657a" disabled style="height:125px;" id='description' placeholder="{{trans('new_trans.ticket.description_placeholder')}}" type="text" wire:model.lazy="description" ></textarea>
                              </div>
                              @error('description')
                                <span class="error text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                      </div>
                  </div>

                  <div class="col-md-4 col-sm-12">
                    <div class="form-group row">
                        <label for="type" class="form-label">
                            {{ trans('new_trans.ticket.ticket_priority') }}
                        </label>
                        <div>
                            <div class="input-group p-0">
                                <div class="input-group-addon">
                                    <i class="fa fa-flash text-danger"></i>
                                </div>
                                    <select class="form-select" id="type" wire:model.prevent="priority" >
                                        @foreach (App\ENUMS\TicketEnum::getLabelTicketPriorities() as $key => $name)
                                            <option value="{{ $key }}">
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                            </div>
                            @error('type')
                              <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-12">
                    <div class="form-group row">
                        <label for="type" class="form-label">
                            {{ trans('new_trans.ticket.ticket_status') }}
                        </label>
                        <div>
                            <div class="input-group p-0">
                                <div class="input-group-addon">
                                    <i class="fa fa-flash text-danger"></i>
                                </div>
                                    <select class="form-select" id="type" wire:model.prevent="status" >
                                        @foreach (App\ENUMS\TicketEnum::getLabelTicketStatus() as $key => $name)
                                            <option value="{{ $key }}">
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                            </div>
                            @error('type')
                              <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                  </div>


                  <div class="col-md-4 col-sm-12">
                    <div class="form-group row">
                        <label for="type" class="form-label">
                            {{ trans('new_trans.ticket.is_resolved.what') }}
                        </label>
                        <div>
                            <div class="input-group p-0">
                                <div class="input-group-addon">
                                    <i class="fa fa-flash text-danger"></i>
                                </div>
                                    <select class="form-select" id="type" wire:model.prevent="is_resolved" >
                                        @foreach (App\ENUMS\TicketEnum::getLabelTicketIsResolved() as $key => $name)
                                            <option value="{{ $key }}">
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                            </div>
                            @error('type')
                              <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                  </div>

              </div>
              <div class="box-footer p-2">
                  <div class="pull-right">

                      <button type="submit" class="btn btn-success" wire:submit="update()" wire:loading.attr='disabled'>
                          @lang('new_trans.ticket.update')
                      </button>

                  </div>
              </div>
          </div>
      </div>
</form>

</div>
</div>
