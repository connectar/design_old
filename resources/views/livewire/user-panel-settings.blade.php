<form wire:submit="save">
    <div class="box border-success m-0">
        <div class="box-body py-0">
            <div class="row">
                <div class="col-12 text-center">
                    @if ($photo)
                        <img src="{{ $photo->temporaryUrl() }}" class="b-1 border-primary rounded-circle" width="80px"
                            height="80px">
                    @else
                        <img src="{{ asset($defaultPhotoPath) }}" class="b-1 border-primary rounded-circle"
                            width="80px" height="80px">
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">
                            {{ __('site.admin_settings.chooce_logo') }}
                        </label>
                        <input class="form-control" type="file" id="formFile" wire:model="photo">
                        @error('photo')
                            <span class="error text-danger">
                                * {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="panelTitle" class="form-label">
                            {{ __('site.admin_settings.site_name') }}
                        </label>
                        <div>
                            <input class="form-control" type="text" id="panelTitle" wire:model.lazy="panelTitle">
                            @error('panelTitle')
                                <span class="error text-danger">
                                    * {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group row">
                        <label for="magazine_url" class="form-label">
                            {{ __('site.admin_settings.magazine_url') }}
                        </label>
                        <div>
                            <div class="input-group">
                                <div class="input-group-addon py-0">
                                    <label class="switch switch-success">
                                        <input type="checkbox" wire:model="show_magazine">
                                        <span class="switch-indicator"></span>
                                    </label>
                                </div>
                                <input class="form-control" type="text" wire:model.lazy="magazine_url" dir="auto"
                                    @if ($show_magazine == false) disabled @endif>
                            </div>
                            @error('magazine_url')
                                <span class="error text-danger">
                                    * {{ $message }}
                                </span>
                            @enderror
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
