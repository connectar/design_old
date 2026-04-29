<form wire:submit="save">
    <div class="box border-success m-0">
        <div class="box-header with-border px-4">
            <h4 class="box-title">
                <a href="" class="btn btn-sm btn-success">
                    <i class="fa spi fa-plus px-2"></i>
                    {{ __('site.edit_drink.title') }}
                    <span>
                        : {{$name }}
                    </span>
                </a>

            </h4>
        </div>
        @if($error)
        <div class="box-body text-center p-2">
            <div>
                <h4 class="text-danger">عفوا هذا المعرف لا ينتمى لاى صنف لدينا</h4>
            </div>
        </div>

        @else
        <div class="box-body py-0">

            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-12 text-center pt-4">
                            @if ($image)
                            <img src="{{ $image->temporaryUrl() }}" class="b-1 border-primary rounded-circle"
                                width="80px" height="80px">
                            @elseif($model->image)
                            <img src="{{ asset($model->image) }}" class="b-1 border-primary rounded-circle" width="80px"
                                height="80px">

                            @else

                            <i class="fa fa-coffee text-primary rounded-circle b-1 border-primary fs-40 p-2"></i>

                            @endif
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">
                                    {{ __('site.add_drink.image') }}
                                </label>
                                <input class="form-control" type="file" id="formFile" wire:model="image">
                                @error('image')
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
                            {{ __('site.add_drink.name_title') }}
                        </label>
                        <div>
                            <input class="form-control" type="text" id="name" wire:model.lazy="name">
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
                        <label for="price" class="form-label">
                            {{ __('site.add_drink.price') }}
                        </label>
                        <div>
                            <input class="form-control" type="text" id="price" wire:model.lazy="price">
                            @error('price')
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
        @endif
    </div>
</form>
