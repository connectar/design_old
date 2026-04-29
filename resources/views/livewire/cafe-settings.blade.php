<form wire:submit="save">
    <div class="box border-success m-0">
        <div class="box-body py-0">

            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-12 text-center pt-4">
                            @if ($photo)
                                <img src="{{ $photo->temporaryUrl() }}"
                                    class="b-1 border-primary rounded-circle" width="80px"
                                    height="80px">
                            @else
                                <img src="{{ asset($defaultPhotoPath) }}"
                                    class="b-1 border-primary rounded-circle" width="80px"
                                    height="80px">
                            @endif
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">
                                    {{ __('site.admin_settings.chooce_logo') }}
                                </label>
                                <input class="form-control" type="file" id="formFile"
                                    wire:model="photo">
                                @error('photo')
                                    <span class="error text-danger">
                                        * {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-12 text-center">
                            @if ($background)
                                <img src="{{ $background->temporaryUrl() }}"
                                    class="b-1 border-primary" width="100%" height="100px">
                            @else
                                <img src="{{ asset($defaultBackgroundPath) }}"
                                    class="b-1 border-primary" width="100%" height="100px">
                            @endif
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">
                                    {{ __('site.cafe_settings.background') }}
                                </label>
                                <input class="form-control" type="file" id="formFile"
                                    wire:model="background">
                                @error('background')
                                    <span class="error text-danger">
                                        * {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="name" class="form-label">
                            {{ __('site.cafe_settings.cafe_name') }}
                        </label>
                        <div>
                            <input class="form-control" type="text" id="name"
                                wire:model.lazy="name">
                            @error('name')
                                <span class="error text-danger">
                                    * {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="phone" class="form-label">
                            {{ __('site.cafe_settings.phone') }}
                        </label>
                        <div>
                            <input class="form-control" type="text" id="phone"
                                wire:model.lazy="phone">
                            @error('phone')
                                <span class="error text-danger">
                                    * {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="phone_other" class="form-label">
                            {{ __('site.cafe_settings.phone_2') }}
                        </label>
                        <div>
                            <input class="form-control" type="text" id="phone_other"
                                wire:model.lazy="phone_other">
                            @error('phone_other')
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
