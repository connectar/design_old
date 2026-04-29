<div class="text-center">
    @if($siteIsDown)

    <div>
        <p>
            <span class="h4">
                @lang('website.website_status_work_off')
                <i class="fa fa-fw fa-hotel text-danger" style="font-size: 25px"></i>
            </span>
        </p>
    </div>
    <div>
        <button class="btn btn-rounded btn-success btn-md ml-5" wire:click="changeSiteStatus">
            @lang('website.button_mintainance_on')
        </button>
    </div>
    @else
    <div>
        <p>
            <span class="h4">
                @lang('website.website_status_work_on')
                <i class="fa fa-fw fa-rocket text-success" style="font-size: 25px"></i>
            </span>
        </p>
    </div>
    <div>
        <button class="btn btn-rounded btn-danger btn-md ml-5" wire:click="changeSiteStatus">
            @lang('website.button_mintainance_off')
        </button>
    </div>

    @endif
</div>
