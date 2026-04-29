@if ($checkInstalledProgress)
    <div>
        <div>
            <span class="h-20 flex-shrink-0 pull-left">
                <input type="checkbox" id="step1" class="filled-in chk-col-success" checked>
                <label for="step1"></label>
            </span>
            <span class="">
                {{ __('site.coova_install.steps.copy_code') }}
            </span>
        </div>
        <div class="mt-2">
            <span class="h-20 flex-shrink-0 pull-left">
                <input type="checkbox" id="step2" class="filled-in chk-col-success" checked
                    disabled>
                <label for="step2"></label>
            </span>
            <span class="">
                {{ __('site.coova_install.steps.check_connecting') }}
            </span>
        </div>
        <div class="mt-2">
            <span class="h-20 flex-shrink-0 pull-left">
                <input type="checkbox" id="step2" class="filled-in chk-col-success" disabled>
                <label for="step2"></label>
            </span>
            <span class="">
                {{ __('site.coova_install.steps.finish_install') }}
            </span>
        </div>
    </div>

    <div class="row align-items-center justify-content-center pt-4">
        <h3 class="text-center text-primary">
            {{ __('site.coova_install.finish_install.title') }}
        </h3>
        <div class="col-12 justify-content-center text-center">
            <div class="spinner-border text-primary" style="width: 4rem; height: 4rem;"
                role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
@else
    @if ($failedInstall)
        <div class="row align-items-center justify-content-center pt-5 mt-4">
            <h3 class="text-center text-danger">
                {{ __('site.coova_install.finish_install.failed') }}
            </h3>
            <div class="col-12 justify-content-center text-center">
                <button class="btn btn-info" wire:click="backToCpoyCode">
                    <i class="fa spi fa-arrow-right px-2"></i>
                    {{ __('site.coova_install.connection_status.back_button') }}
                </button>
            </div>
        </div>
    @else
        <div>
            <div>
                <span class="h-20 flex-shrink-0 pull-left">
                    <input type="checkbox" id="step1" class="filled-in chk-col-success" checked>
                    <label for="step1"></label>
                </span>
                <span class="">
                    {{ __('site.coova_install.steps.copy_code') }}
                </span>
            </div>
            <div class="mt-2">
                <span class="h-20 flex-shrink-0 pull-left">
                    <input type="checkbox" id="step2" class="filled-in chk-col-success" checked
                        disabled>
                    <label for="step2"></label>
                </span>
                <span class="">
                    {{ __('site.coova_install.steps.check_connecting') }}
                </span>
            </div>
            <div class="mt-2">
                <span class="h-20 flex-shrink-0 pull-left">
                    <input type="checkbox" id="step2" class="filled-in chk-col-success" checked
                        disabled>
                    <label for="step2"></label>
                </span>
                <span class="">
                    {{ __('site.coova_install.steps.finish_install') }}
                </span>
            </div>
        </div>

        <div class="row align-items-center justify-content-center pt-4">
            <h3 class="text-center text-success">
                <i class="fa fa-check fs-22 px-2"></i>
                {{ __('site.coova_install.finish_install.success') }}
            </h3>
            <div class="col-12 justify-content-center text-center">
                <a href="{{ route('admins.users.create') }}" class="btn btn-info">
                    <i class="fa spi fa-plus px-2"></i>
                    {{ __('site.coova_install.finish_install.add_user') }}
                </a>
            </div>
        </div>
    @endif
@endif
