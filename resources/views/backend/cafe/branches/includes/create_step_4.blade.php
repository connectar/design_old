<div class="box">
    <div class="box-header no-border py-2 text-center">
        <h4 class="box-title">
            <span class="text-primary">

            </span>
        </h4>
    </div>
    <div class="box-body py-0">
        <div>
            <div class="text-center">
                <span class="text-primary">
                    {{ __('site.cafe_branches.create.step_4.message_1') }}
                    <span class="fs-20 text-warning">
                        {{ $content['price'] ?? '0' }}
                    </span>
                    {{ __('site.cafe_branches.create.step_4.pound') }}
                    {{ __('site.cafe_branches.create.step_4.message_2') }}
                    <span class="fs-20 text-warning">{{ $content['account'] ?? 0 }}</span>
                    جنيه لاتمام شراء الكافيه
                </span>
            </div>
            <div class="text-center">
                <span class="text-danger fs-20">
                    هل انت متاكد من الاستمرار ؟
                </span>
            </div>
        </div>
    </div>
    <div class="box-footer no-border text-center">
        <a href="#" class="btn btn-dark text-primary" wire:click="$set('step','2')">
            <i class="fa fa-arrow-right"></i>
            {{ __('website.back') }}
        </a>
        <button type="button" class="btn btn-success" wire:click="save"
            wire:loading.attr="disabled">
            @lang('website.save')
        </button>

    </div>
</div>
