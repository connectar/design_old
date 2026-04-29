<div class="box box-bordered border-danger m-0 no-padding">
    <div class="box-header with-border py-3">
        <h4 class="box-title">
            تعديل مهمة
        </h4>
    </div>
    <div class="box-body no-padding">
        <div class="box border-success m-0">
            <!-- /.box-header -->
            <div class="box-body">

                <div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="fullname" class="col-form-label">
                                    المهمة
                                </label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-tags text-success"></i>
                                        </div>
                                        <input class="form-control" type="text"
                                            wire:model.lazy="subject" dir="ltr">
                                    </div>
                                </div>
                            </div>
                            @error('subject')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="fullname" class="col-form-label">
                                    تفاصيل اضافيه
                                </label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-bookmark text-primary"></i>
                                        </div>
                                        <textarea class="form-control" type="text" wire:model.lazy="content" dir="ltr"></textarea>
                                    </div>
                                </div>
                            </div>
                            @error('content')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="quta" class="form-label">
                                    المدير
                                </label>
                                <div>
                                    <div class="input-group p-0">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user text-info"></i>
                                        </div>
                                        <select class="form-select" wire:model.lazy="admin">
                                            @foreach (__('site.tasks.admins') as $key => $name)
                                                <option value="{{ $key }}">
                                                    {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('admin')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="quta" class="form-label">
                                    الاولويه
                                </label>
                                <div>
                                    <div class="input-group p-0">
                                        <div class="input-group-addon">
                                            <i class="fa fa-flash text-danger"></i>
                                        </div>
                                        <select class="form-select" wire:model.lazy="priority">
                                            @foreach (__('site.tasks.priority') as $key => $name)
                                                <option value="{{ $key }}">
                                                    {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('priority')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
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

            <a href="#" data-bs-dismiss="modal" wire:click="buttonCancelClicked"
                class="btn btn-danger">
                {{ __('website.cancel') }}
            </a>
            <button type="button" class="btn btn-success" wire:click="save">
                @lang('website.save')
            </button>

        </div>
    </div>
</div>

<!-- /.box -->
