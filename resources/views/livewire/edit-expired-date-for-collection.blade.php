<form wire:submit="submitForm">
    <div class="box border-success m-0">
        <div class="box-header with-border">
            <h4 class="box-title">
                {{ __('site.user_index.edit_expired_date.title2') }}
            </h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="p-2">
                @error('userId')
                    <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group row">
                        <label for="fullname" class="col-form-label">
                            @lang('adding.user_option.expired_at')
                        </label>
                        <div>
                            <input class="form-control" type="text" id="datepicker" readonly
                                wire:model.lazy="expired_at">
                        </div>
                    </div>
                    @error('expired_at')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="pull-right">

                <a href="#" data-bs-dismiss="modal" class="btn btn-danger"
                    wire:click="buttonCancelClicked">
                    {{ __('website.cancel') }}
                </a>
                <button type="submit" class="btn btn-success">
                    {{ __('website.update') }}
                </button>
            </div>
        </div>
    </div>
</form>
