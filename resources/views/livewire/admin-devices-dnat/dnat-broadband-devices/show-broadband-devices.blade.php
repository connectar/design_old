<div class="box box-bordered border-danger m-0 no-padding"
    style="position: fixed;left:0;top:0;bottom:0;right:0;">
    <div class="box-body no-padding">
        @if ($step == 1)
            <div class="row align-items-center justify-content-center h-p100">
                <div class="col-12 justify-content-center text-center">
                    <div class="spinner-border text-success" style="width: 4rem; height: 4rem;"
                        role="status">
                    </div>
                    <div class="text-primary">
                        {{ __('site.devices_index.show_device_alert') }}
                    </div>
                </div>
            </div>

            @elseif($step == 2)
            <iframe src="{{ $urlInside }}" id="myIframe"
                style="overflow:hidden;overflow-x:hidden;overflow-y:hidden;height:100%;width:100%;position:absolute;top:0px;left:0px;right:0px;bottom:0px;"
                height="100%" width="100%">
            </iframe>
            {{-- loading spinner --}}
            <div class="h-p100" id="loading" style="display: none">
                <div class="row align-items-center justify-content-center h-p100">
                    <div class="col-12 justify-content-center text-center">
                        <div class="spinner-border text-primary" style="width: 4rem; height: 4rem;"
                            role="status">
                        </div>
                        <div class="text-primary">
                            {{ __('site.devices_index.loading_alert_vpn') }}
                        </div>
                    </div>
                </div>
            </div>
            {{-- loading spinner --}}

        @elseif($step == 3)
            <div class="row align-items-center justify-content-center h-p100">
                <div class="col-12 justify-content-center text-center">
                    <div class="px-4">
                        <div class="alert text-center text-bold">
                            <i class="fa fa-warning text-primary fs-20"></i>
                            @if ($errorMessageKey == 'device_conenct_error')
                                <div class="mt-2 text-success">
                                    تم الاتصال بالسيرفر بنجاح
                                </div>
                            @endif
                            <div class="mt-2 text-primary">
                                {{ __('site.devices_index.errors.' . $errorMessageKey) }}
                            </div>
                            <div class="pt-2">
                                <a href="#" data-bs-dismiss="modal"
                                    wire:click="buttonCancelClicked" class="btn btn-sm btn-danger">
                                    {{ __('website.close') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <!-- /.box-body -->
</div>
