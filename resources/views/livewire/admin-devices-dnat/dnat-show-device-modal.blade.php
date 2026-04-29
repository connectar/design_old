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
            <iframe src="https://connect4ar.com:7007" id="myIframe"
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
                            {{ __('site.devices_index.loading_alert') }}
                        </div>
                    </div>
                </div>
            </div>
            {{-- loading spinner --}}

            <div style="position:fixed;left:20px;bottom:0px;z-index=2900">

                <div id="chat-box-body" class="@if ($showBoxContent) show @endif">
                    <div id="chat-circle"
                        class="waves-effect waves-circle btn btn-circle btn-lg btn-primary h-40 w-40 rounded-circle l-h-40"
                        wire:click="showBox" style="bottom:25px;left:25px;z-index:2000">
                        <div id="chat-overlay"></div>
                        <i class="fa fa-gear fs-20"></i>
                    </div>

                    <div class="chat-box b-1">
                        <div class="chat-box-header p-1">
                            <div class="chat-box-toggle d-flex flex-row-reverse">
                                <button id="chat-box-toggle"
                                    class="waves-effect waves-circle btn btn-sm btn-circle btn-warning rounded-circle"
                                    type="button" wire:click="$toggle('showBoxContent')">
                                    <i class="fa fa-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="chat-box-body">
                            <div class="chat-box-overlay">
                            </div>
                            <div class="p-15">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <label for="type" class="form-label">
                                                {{ __('site.devices_index.open_new_device') }}
                                            </label>
                                            <div>
                                                <select class="form-select"
                                                    wire:model="opendDevice">
                                                    @foreach ($allDevices as $index => $array)
                                                        <option value="{{ $array['id'] }}">
                                                            {{ $array['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col12">
                                        <div>
                                            <span class="badge text-primary">
                                                {{ __('site.devices_index.device_info.title') }}
                                            </span>
                                            <table class="table no-border table-striped bg-dark">
                                                <tr>
                                                    <td>
                                                        {{ __('site.devices_index.device_info.name') }}
                                                    </td>
                                                    <td>
                                                        {{ $device_name ?? '---' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        {{ __('site.devices_index.device_info.ip') }}
                                                    </td>
                                                    <td>
                                                        {{ $private_address ?? '---' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="text-center">
                                            <button data-bs-dismiss="modal"
                                                wire:click="buttonCancelClicked"
                                                class="btn btn-sm btn-danger btn-block">
                                                {{-- <i class="fa fa-close"></i> --}}
                                                {{ __('site.devices_index.device_info.close') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--chat-log -->
                        </div>
                    </div>
                </div>
            </div>
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
