<form wire:submit="submitForm">
    <div class="box b-1 border-primary m-0">
        <div class="box-header with-border">
            <h4 class="box-title">
                تعديل اسم الواى فاى
            </h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            @if ($step == 1)
            <div class="row align-items-center justify-content-center pt-4">
                <h4 class="text-center text-success">
                    {{ __('site.nas_index.edit_admin_password.connect') }}
                </h4>
                <div class="col-12 justify-content-center text-center">
                    <div class="spinner-border text-success" style="width: 4rem; height: 4rem;" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            @elseif($step == 2)
            <div class="row">
                <!-- /.col -->
                <div class="col-12">
                    <div class="form-group row">
                        <label for="quta" class="form-label">
                            اختر الشبكة المراد تغيير اسمها
                        </label>
                        <div>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-wifi text-warning"></i>
                                </div>
                                <select class="form-select" wire:model="selectedNetwork">
                                    @foreach($networks as $key => $value)
                                    <option value="{{$key}}">
                                        {{$value}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group row">
                        <label for="fullname" class="col-form-label">
                            اكتب اسم الشبكة الجديد
                        </label>
                        <div>
                            <input class="form-control" type="text" wire:model='name'>
                        </div>
                    </div>
                    @error('name')
                    <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            @elseif($step == 3)
            <div>
                <div class="row align-items-center justify-content-center pt-4">
                    <h4 class="text-center text-danger">
                        {{ __('site.nas_index.edit_admin_password.error') }}
                    </h4>
                </div>
            </div>
            @endif
        </div>
        <!-- /.box-body -->
        @if ($step != 1)
        <div class="box-footer">
            <div class="pull-right">
                @if ($step != 1)
                <a href="#" class="btn btn-danger" wire:click="buttonCancelClicked">
                    {{ __('website.cancel') }}
                </a>
                @endif
                @if ($step == 2)
                <button type="submit" class="btn btn-success">
                    {{ __('website.save') }}
                </button>
                @endif
            </div>
        </div>
        @endif
    </div>
</form>
