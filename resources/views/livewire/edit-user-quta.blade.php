<div class="box box-bordered">
    <div class="box-body">
        <div class="box border-success">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <div class="box box-body pull-up bg-dark text-center">
                            <div class="">
                                <span class="fw-200 fs-20 text-primary" dir="auto">
                                    {{ $upload ?? 0 }}
                                </span>
                            </div>
                            <div class="text-center">
                                {{ __('site.user_edit.edit_quta_tab.upload') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="box box-body pull-up bg-dark">
                            <div class="text-center">
                                <span class="fw-200 fs-20 text-danger" dir="auto">
                                    {{ $download ?? 0 }}
                                </span>
                            </div>
                            <div class="text-center">
                                {{ __('site.user_edit.edit_quta_tab.download') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="box box-body pull-up bg-dark">
                            <div class="text-center">
                                <span class="fw-200 fs-20 text-success" dir="auto">
                                    {{ $total ?? 0 }}
                                    <span class="text-muted">/</span>
                                    <span class="text-warning fs-22">
                                        {{ $total_quta == 0 ? 'غير محدود' : $total_quta }}
                                    </span>
                                </span>
                            </div>
                            <div class="text-center">
                                {{ __('site.user_edit.edit_quta_tab.total') }}
                            </div>
                        </div>
                    </div>
                </div>
                @if ($user->total_quta > 0)
                    <div class="row">
                        <div class="demo-radio-button">

                            <input type="radio" name="quta_system" wire:model="quta_system"
                                class="with-gap radio-col-success" id="plus" value="plus">
                            <label for="plus">
                                {{ __('site.user_edit.edit_quta_tab.quta_system.plus') }}
                            </label>
                            <input type="radio" name="quta_system" wire:model="quta_system"
                                class="with-gap radio-col-danger" id="mins" value="mins">
                            <label for="mins">
                                {{ __('site.user_edit.edit_quta_tab.quta_system.mins') }}
                            </label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="quta"
                                    class="form-label @if ($quta_system == 'plus') text-success @else text-danger @endif">
                                    {{ __('site.user_edit.edit_quta_tab.select_title.' . $quta_system) }}
                                </label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-cloud-download text-warning"></i>
                                        </div>
                                        <input class="form-control" type="number" min="1"
                                            wire:model.lazy="quta">
                                        <div class="input-group-addon p-0">
                                            <select class="form-select" wire:model.lazy="quta_unit">
                                                @foreach (config('offers.quta_unit') as $unit)
                                                    <option value="{{ $unit }}">
                                                        {{ __('adding.offer.quta_' . $unit) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('quta')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    <span class="text-danger">
                                        @error('quta_unit')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert text-center bg-dark text-primary">
                        عفوا هذا العميل على عرض غير محدود قم بتغير عرضه اولا
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer p-2">
        <div class="pull-right">
            <a href="{{ route('admins.users.index') }}" class="btn btn-danger">
                {{ __('website.cancel') }}
            </a>
            <button type="button" class="btn btn-success" x-on:click="editQuta">
                @lang('website.save')
            </button>

        </div>
    </div>
</div>

<!-- /.box -->
