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

    <h5 class="text-danger">
        <p class="pt-3">
            {{ __('site.nas_show_content') }}
        </p>
    </h5>
</div>
