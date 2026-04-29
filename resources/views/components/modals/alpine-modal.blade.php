@props(['id', 'maxWidth', 'show' => 'show', 'withBorders' => false])

@php
    $id = $id ?? md5($attributes->wire('model'));

    $maxWidth = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
        '3xl' => 'sm:max-w-3xl',
        '4xl' => 'sm:max-w-4xl',
        '5xl' => 'sm:max-w-5xl',
        '6xl' => 'sm:max-w-6xl',
        '7xl' => 'sm:max-w-7xl',
    ][$maxWidth ?? '2xl'];
@endphp

<div x-on:close.stop="{{ $show }} = false" x-on:close-alpine-modal.window="{{ $show }} = false"
    x-on:keydown.escape.window="{{ $show }} = false" x-show="{{ $show }}" id="{{ $id }}"
    class="jetstream-modal fixed-custom inset-0 overflow-y-auto z-50 sm-right-0 sm-top-0"
    style="z-index: 999999;right:30%;top:3%;display:none;">

    <div x-show="{{ $show }}" class="fixed-custom inset-0 transform transition-all backdrop-blur-sm"
        style="z-index: -1!important;" x-on:click="{{ $show }} = false"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="absolute inset-0 bg-c-gray-800 opacity-25" style="position: absolute! important;"></div>
    </div>

    <div x-show="{{ $show }}"
        class="mb-6  rounded-lg  shadow-xl transform transition-all sm:w-full {{ $maxWidth }} sm:mx-auto"
        style="width:100%;background-color:#0c1a32;padding:25px;border-radius: 10px;{{ $withBorders ? $withBorders : '' }}"
        x-trap.inert.noscroll="{{ $show }}" x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
        {{ $slot }}
    </div>
</div>

@push('styles')
    <style>
        .fixed-custom {
            position: fixed ! important;
        }

        @media(max-width: 720px) {
            .sm-right-0 {
                right: 0px ! important;
            }

            .sm-top-0 {
                top: 0px ! important;
            }
        }

        .inset-0 {
            inset: 0px;
        }

        .overflow-y-auto {
            overflow-y: auto;
        }

        .transform {
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
        }

        .scrollbar-track-purple-800 {
            scrollbar-color: #5b21b6 transparent;
        }

        .scrollbar-thumb-purple-500 {
            scrollbar-color: #a855f7 #5b21b6;
        }

        .dark\:scrollbar-thumb-gray-600 {
            scrollbar-color: #4b5563 #1f2937;
        }

        .dark\:scrollbar-track-gray-800 {
            scrollbar-color: #1f2937 transparent;
        }

        .translate-y-4 {
            --tw-translate-y: 1rem
                /* 16px */
            ;
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
        }

        .translate-y-0 {
            --tw-translate-y: 0px;
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
        }

        .backdrop-blur-sm {
            backdrop-filter: blur(4px);
        }

        .bg-c-gray-800 {
            background-color: #1c1c1e;
        }

        .opacity-25 {
            opacity: 0.25;
        }

        .mb-6 {
            margin-bottom: 1.5rem;
        }

        .bg-white {
            background-color: #ffffff;
        }

        .rounded-lg {
            border-radius: 0.5rem;
        }

        .shadow-xl {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }

        .sm\:max-w-sm {
            max-width: 24rem;
        }

        .sm\:max-w-md {
            max-width: 28rem;
        }

        .sm\:max-w-lg {
            max-width: 32rem;
        }

        .sm\:max-w-xl {
            max-width: 36rem;
        }

        .sm\:max-w-2xl {
            max-width: 42rem;
        }

        .sm\:max-w-3xl {
            max-width: 48rem;
        }

        .sm\:max-w-4xl {
            max-width: 56rem;
        }

        .sm\:max-w-5xl {
            max-width: 64rem;
        }

        .sm\:max-w-6xl {
            max-width: 72rem;
        }

        .sm\:max-w-7xl {
            max-width: 80rem;
        }

        .ease-out {
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        }

        .ease-in {
            transition-timing-function: cubic-bezier(0.4, 0, 1, 1);
        }

        .duration-300 {
            transition-duration: 300ms;
        }

        .duration-200 {
            transition-duration: 200ms;
        }

        .opacity-0 {
            opacity: 0;
        }

        .opacity-100 {
            opacity: 1;
        }

        .translate-y-4 {
            transform: translateY(1rem);
        }

        .sm\:translate-y-0 {
            transform: translateY(0);
        }

        .sm\:scale-95 {
            transform: scale(0.95);
        }

        .sm\:scale-100 {
            transform: scale(1);
        }
    </style>
@endpush
