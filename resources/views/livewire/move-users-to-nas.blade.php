<form wire:submit="submitForm">
    <div class="box border-success m-0">
        <div class="box-header with-border">
            <h4 class="box-title">
                نقل الى سيرفر اخر
            </h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="px-20">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group row">
                            <label for="distributer" class="form-label">
                                {{ __('site.move_to_nas.select') }}
                            </label>
                            <div>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <select class="form-select" id="selectNas" wire:model="selectedNas">
                                        @foreach ($nas as $nas)
                                        <option value="{{ $nas['serial'] }}" @if($loop->first) selected @endif>
                                            {{ $nas['name'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="pull-right">

                <a href="#" data-bs-dismiss="modal" class="btn btn-danger" wire:click="buttonCancelClicked">
                    {{ __('website.cancel') }}
                </a>
                <button type="submit" class="btn btn-success">
                    {{ __('website.update') }}
                </button>
            </div>
        </div>
    </div>
</form>
