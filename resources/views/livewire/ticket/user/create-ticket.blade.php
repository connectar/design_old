<div>

<div>
    <form wire:submit='create()' >
    <div class="box box-bordered  m-0 p-3">
        <div class="box-header with-border py-3" style="width:100%;display:flex;justify-content:space-between;align-items:start;">
			<div>
				<h4 class="box-title">
					{{ trans('new_trans.ticket.send_ticket') }}
				</h4>
			</div>
			<div>

				<a href="{{route($this->redirectToMyTicketsTableRoute())}}" class="btn btn-danger btn-sm " >
					<i class="fa fa-arrow-left"></i>
					{{__('menu.tickets.mytickets')}}
				</a>
			</div>
		</div>
        <div class="box-body no-padding">
            <div class="box border-success m-0">
                <!-- /.box-header -->
                <div class="box-body">

                    <div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="title" class="col-form-label">
                                        {{ trans('new_trans.ticket.ticket_title') }}
                                    </label>
                                    <div>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-tags text-success"></i>
                                            </div>
                                            <input class="form-control" id='title' type="text"
                                                wire:model.lazy="title" >
                                        </div>
										@error('title')
											<span class="error text-danger">{{ $message }}</span>
										@enderror
                                    </div>
                                </div>
                            </div>
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
                                            <textarea class="form-control" style="height:125px;" id='description' placeholder="{{trans('new_trans.ticket.description_placeholder')}}" type="text" wire:model.lazy="description" ></textarea>
                                        </div>
										@error('description')
											<span class="error text-danger">{{ $message }}</span>
										@enderror
                                    </div>
                                </div>

                            </div>
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="type" class="form-label">
                                        {{ trans('new_trans.ticket.ticket_type') }}
                                    </label>
                                    <div>
                                        <div class="input-group p-0">
                                            <div class="input-group-addon">
                                                <i class="fa fa-flash text-danger"></i>
                                            </div>
                                                <select x-data="{ type: null, hasSelected: false }" class="form-select" id="type" wire:model.prevent="type" x-model="type" @change="hasSelected = true">
                                                    <option value=""  selected x-bind:disabled="hasSelected">
                                                        {{ __('new_trans.ticket.select_ticket_type') }}
                                                    </option>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer p-2">
            <div class="pull-right">

                <button type="button" class="btn btn-success" wire:click="create()" wire:loading.attr='disabled'>
                    @lang('new_trans.ticket.send')
                </button>

            </div>
        </div>
    </div>

</form>
    <!-- /.box -->

</div>
</div>
