<div class="box-footer py-2">
    <div class="pull-right">

    <a href="{{ $cancelRoute }}" class="btn {{ $cancelClass }}">
        {{ $cancelText ?? __('website.cancel') }}
    </a>
    <button type="submit" class="btn mx-2 {{ $submitClass }}">
        {{ $submitText ?? __('website.save') }}
    </button>
    </div>
</div>
