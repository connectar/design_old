<div class="d-block d-md-none">
    @if ($tabActive == 1)
        @if (count($qutaUsage) > 0)
            @if ($step == 1)
                <div class="px-2 py-2">
                    <div class="row">
                        @foreach ($qutaUsage as $model)
                            <div class="col-12">
                                <div class="box box-bordered border-dark">
                                    <div class="box-header py-1">
                                        التاريخ : <span class="text-warning"
                                            dir="auto">{{ $model->acctstarttime }}</span>
                                    </div>
                                    <div class="box-body py-2">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <label for="fullname" class="form-label">
                                                        التنزيلات
                                                    </label>
                                                    <div>
                                                        <span
                                                            class="badge badge-dark text-primary d-block"
                                                            dir="auto">
                                                            {{ $model->render()->download() }}
                                                            <i class="fa fa-arrow-down"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <label for="fullname" class="form-label">
                                                        الرفع
                                                    </label>
                                                    <div>
                                                        <span
                                                            class="badge badge-dark text-primary d-block"
                                                            dir="auto">
                                                            {{ $model->render()->upload() }}
                                                            <i class="fa fa-arrow-up"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <label class="form-label">
                                                        اجمالى الاستهلاك
                                                    </label>
                                                    <div>
                                                        <span
                                                            class="badge badge-dark text-primary d-block"
                                                            dir="auto">
                                                            {{ $model->render()->total() }}
                                                            <i class="fa fa-arrow-down"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <label class="form-label">
                                                        اجمالى الوقت
                                                    </label>
                                                    <div>
                                                        <span
                                                            class="badge badge-dark text-primary d-block"
                                                            dir="auto">
                                                            {{ $model->render()->uptime() }}
                                                            <i class="fa fa-clock-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my-1 text-center">
                                            <a href="#"
                                                class="waves-effect waves-light btn btn-sm btn-info text-bold btn-rounded"
                                                wire:click="showUsageBerDay('{{ $model['acctstarttime'] }}')">
                                                <i class="fa fa-edit"></i>
                                                {{ __('site.user_index.quta_usage.info') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="px-2 py-2">
                    <div class="row">
                        @foreach ($qutaUsagePerDay as $model)
                            <div class="col-12">
                                <div class="box box-bordered border-dark">
                                    <div class="box-header py-1">
                                        <div>
                                            وقت البدء : <span class="text-warning" dir="auto">
                                                {{ $model->render()->acctstarttime() }}
                                            </span>
                                        </div>
                                        <div>
                                            وقت الانتهاء : <span class="text-danger" dir="auto">
                                                {{ $model->render()->acctstoptime() }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="box-body py-2">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <label for="fullname" class="form-label">
                                                        التنزيلات
                                                    </label>
                                                    <div>
                                                        <span
                                                            class="badge badge-dark text-primary d-block"
                                                            dir="auto">
                                                            {{ $model->render()->download() }}
                                                            <i class="fa fa-arrow-down"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <label for="fullname" class="form-label">
                                                        الرفع
                                                    </label>
                                                    <div>
                                                        <span
                                                            class="badge badge-dark text-primary d-block"
                                                            dir="auto">
                                                            {{ $model->render()->upload() }}
                                                            <i class="fa fa-arrow-up"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <label class="form-label">
                                                        اجمالى الاستهلاك
                                                    </label>
                                                    <div>
                                                        <span
                                                            class="badge badge-dark text-primary d-block"
                                                            dir="auto">
                                                            {{ $model->render()->total() }}
                                                            <i class="fa fa-arrow-down"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <label class="form-label">
                                                        اجمالى الوقت
                                                    </label>
                                                    <div>
                                                        <span
                                                            class="badge badge-dark text-primary d-block"
                                                            dir="auto">
                                                            {{ $model->render()->uptime() }}
                                                            <i class="fa fa-clock-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <label class="form-label">
                                                        الماك ادريس
                                                    </label>
                                                    <div>
                                                        <span
                                                            class="badge badge-dark text-primary d-block"
                                                            dir="auto">
                                                            {{ $model->macaddress ?? '---' }}
                                                            <i class="fa fa-barcode"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @else
            <div class="text-center py-4">
                <x-datatable.empty-records />
            </div>
        @endif
    @else
        @if (count($olderUsage) > 0)
            <div class="px-2 py-2">
                <div class="row">
                    @foreach ($olderUsage as $model)
                        <div class="col-12">
                            <div class="box box-bordered border-dark">
                                <div class="box-header py-1">
                                    <div>
                                        وقت البدء : <span class="text-warning" dir="auto">
                                            {{ $model->render()->from() }}
                                        </span>
                                    </div>
                                    <div>
                                        وقت الانتهاء : <span class="text-danger" dir="auto">
                                            {{ $model->render()->to() }}
                                        </span>
                                    </div>
                                </div>
                                <div class="box-body py-2">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group row">
                                                <label for="fullname" class="form-label">
                                                    التنزيلات
                                                </label>
                                                <div>
                                                    <span
                                                        class="badge badge-dark text-primary d-block"
                                                        dir="auto">
                                                        {{ $model->render()->download() }}
                                                        <i class="fa fa-arrow-down"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group row">
                                                <label for="fullname" class="form-label">
                                                    الرفع
                                                </label>
                                                <div>
                                                    <span
                                                        class="badge badge-dark text-primary d-block"
                                                        dir="auto">
                                                        {{ $model->render()->upload() }}
                                                        <i class="fa fa-arrow-up"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group row">
                                                <label class="form-label">
                                                    اجمالى الاستهلاك
                                                </label>
                                                <div>
                                                    <span
                                                        class="badge badge-dark text-primary d-block"
                                                        dir="auto">
                                                        {{ $model->render()->total() }}
                                                        <i class="fa fa-arrow-down"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group row">
                                                <label class="form-label">
                                                    اجمالى الوقت
                                                </label>
                                                <div>
                                                    <span
                                                        class="badge badge-dark text-primary d-block"
                                                        dir="auto">
                                                        {{ $model->render()->uptime() }}
                                                        <i class="fa fa-clock-o"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="text-center py-4">
                <x-datatable.empty-records />
            </div>
        @endif
    @endif
</div>
