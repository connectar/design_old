<div>
  <form wire:submit="sendMessage">
      <div class="box box-bordered border-danger m-0 p-4 pb-1">
          <div class="box-header with-border py-3">
              <h4 class="box-title">
                  {{ __('site.user_index.send_message.send_message_to_user_title') }} :
                  <span class="text-primary px-1">
      				{{ optional($user)->fullname }}
                  </span>
              </h4>
          </div>
          	<div class="box-body no-padding">

				<div class="col-12">
					<div class="form-group row">
						<label for="message" class="col-form-label">
							{{ trans('new_trans.admin_messages.message') }}
						</label>
						<div>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-bookmark text-primary"></i>
								</div>
							<textarea class="form-control" style="height:125px;" id='message' placeholder="{{trans('new_trans.admin_messages.message_placeholder')}}" type="text" wire:model="message" ></textarea>
							</div>
							@error('message')
								<span class="error text-danger">{{ $message }}</span>
							@enderror
						</div>
					</div>
				</div>
				<div class="col-sm-12 py-3 px-4 custom-margin-mobile">
					<label for="message" class="col-form-label">
						{{ trans('new_trans.admin_messages.sendto') }}
					</label>
					<div class="d-flex justify-content-around">
						<input name="invoiceStatus" wire:model="channel"
						type="radio" id="radio_32"
						class="with-gap radio-col-success" value="{{App\ENUMS\AdminMessageEnum::CHANNEL_ALL}}">
						<label for="radio_32">
							{{ trans('new_trans.admin_messages.channels.all') }}
						</label>
						<input name="invoiceStatus" wire:model="channel"
						type="radio" id="radio_36"
						class="with-gap radio-col-success" value="{{App\ENUMS\AdminMessageEnum::CHANNEL_APP}}">
						<label for="radio_36">
							{{ trans('new_trans.admin_messages.channels.app') }}
						</label>
						<input name="invoiceStatus" wire:model="channel"
						type="radio" id="radio_35"
						class="with-gap radio-col-success" value="{{App\ENUMS\AdminMessageEnum::CHANNEL_TELEGRAM}}">
						<label for="radio_35">
							{{ trans('new_trans.admin_messages.channels.telegram') }}
						</label>
					</div>
				</div>
			</div>
          <!-- /.box-body -->
          <div class="box-footer">
              <div class="pull-right">
                  <a href="#" data-bs-dismiss="modal" class="btn btn-danger">
                      {{ __('website.cancel') }}
                  </a>
                  <button type="submit" class="btn btn-success">
                      @lang('new_trans.send')
                  </button>
              </div>
          </div>
      </div>
  </form>
  <!-- /.box -->
</div>
