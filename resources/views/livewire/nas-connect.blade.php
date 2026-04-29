<div class="row">

    <div class="box bt-3 border-success">
        <div class="box-header with-border p-3 px-4 text-center">
            <h4 class="box-title">@lang('site.nas_show_title')</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="text-center">
                <h4>
                    <span>
                        {{ __('site.nas_show_button_copy') }}
                    </span>
                    <button class="btn btn-info fw-bold btn-rounded" wire:click="$dispatch('copyScript',{{$nasId}})">
                        {{__('site.nas_click_here')}}
                    </button>
                    <span>
                        {{ __('site.nas_show_button_copy_after') }}
                    </span>
                </h4>

                <blockquote class="blockquote blockquote-reverse text-center">
                    <p class="m-2">
                        {{__('site.nas_show_content')}}
                    </p>
                </blockquote>
                <p>
                <h5>
                    <span class="text-danger fw-bold">@lang('site.nas_check_connect')</span>
                    <button type="submit" class="btn btn-dark btn-rounded fw-bolder"
                        wire:click="$dispatch('checkConnectStatus',{{$nasId}})">
                        {{__('site.nas_click_here')}}
                    </button>
                </h5>
                </p>
            </div>
        </div>
        <!-- /.box-body -->
    </div>

</div>
