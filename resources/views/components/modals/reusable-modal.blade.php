@props(['id' => null, 'maxWidth' => 'modal-md', 'show' => 'show'])

<div>
    <div x-show="{{ $show }}" id="{{ $id }}" style="display: block!important;" class="custom-modal"
        tabindex="-1" role="dialog" aria-hidden="true" x-on:keydown.escape.window="{{ $show }} = false">

        <div class="modal-dialog {{ $maxWidth }}" role="document">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">{{ $title ?? __('Modal Title') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        x-on:click="{{ $show }} = false"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    {{ $content }}
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    {{ $footer ?? '' }}
                    <button type="button" class="btn btn-secondary"
                        x-on:click="{{ $show }} = false">{{ __('Close') }}</button>
                </div>
            </div>
        </div>

        {{-- <!-- Backdrop -->
        <div class="modal-backdrop fade show" x-show="{{ $show }}" x-transition:enter="fade"
            x-transition:leave="fade" x-on:click="{{ $show }} = false"></div> --}}
    </div>
</div>
@push('styles')
    <style>
        .custom-modal {
            position: fixed;
            display: inline-block;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            z-index: 9999;
            background-color: rgba(0, 0, 0, 0.5);
            overflow: auto;
            -webkit-overflow-scrolling: touch;
            text-align: center;
            padding: 0;
            border: none;
            border-radius: 0;
        }
    </style>
@endpush
