@inject('QrCode', 'SimpleSoftwareIO\QrCode\Facades\QrCode')<div class="mt-20 text-center">
    <div class="mt-20 text-center">
        <h4>
            <span>
                {{ __('site.nas_show_button_copy') }}
            </span>
            <button type="button" class="btn btn-info fw-bold btn-rounded" wire:click="copyScript">
                {{ __('site.nas_click_here') }}
            </button>
            <span>
                {{ __('site.nas_show_button_copy_after') }}
            </span>
        </h4>

        {{-- <div>
            <img src="data:image/png;base64, {!! base64_encode(
                QrCode::encoding('UTF-8')->format('png')->errorCorrection('L')->size(120)->generate($installCode),
            ) !!} ">
        </div> --}}
        <div>
            {!! QrCode::size(120)->generate($installCode) !!}
        </div>

        <h5 class="text-danger">
            <p class="pt-3">
                {{ __('site.nas_show_content') }}
            </p>
        </h5>
    </div>
