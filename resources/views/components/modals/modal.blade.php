@props(['id' => null, 'maxWidth' => null, 'show' => 'show', 'withBorders' => false])

<x-modals.alpine-modal :id="$id" :withBorders="$withBorders" :show="$show" :maxWidth="$maxWidth" {{ $attributes }}>
    <div>
        <div class="fw-bold fs-22 text-primary">
            {{ $title }}
        </div>

        <div class="mt-4 row" style="margin-top: 1rem !important;">
            {{ $content }}
        </div>
    </div>

    <div class="px-3 py-2" style="display: flex; flex-direction: row; justify-content: flex-end; align-items: center;">
        {{ $footer }}
    </div>
</x-modals.alpine-modal>
