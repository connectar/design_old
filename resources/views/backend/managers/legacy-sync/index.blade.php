@extends('backend.layouts.dashboard')

@section('title', __('legacy_sync.title'))

@section('content')
    @livewire('legacy-sync.legacy-sync-dashboard')
@endsection

@push('scripts')
    <script>
        /**
         * Copy the text of the closest <pre.legacy-error> to clipboard.
         * Defined here (parent layout) so it survives Livewire re-renders.
         */
        window.copyLegacyError = function (btn) {
            var pre = null;
            var container = btn.closest('.alert, .position-relative, details, td');
            if (container) {
                pre = container.querySelector('pre.legacy-error');
            }
            if (!pre) { return; }

            var text = pre.innerText;
            var done = function () {
                var orig = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-check"></i> {{ __('legacy_sync.diagnostics.copied') }}';
                btn.classList.add('btn-success');
                setTimeout(function () {
                    btn.innerHTML = orig;
                    btn.classList.remove('btn-success');
                }, 1500);
            };

            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(done).catch(fallback);
            } else {
                fallback();
            }

            function fallback() {
                var ta = document.createElement('textarea');
                ta.value = text;
                ta.style.position = 'fixed';
                ta.style.left = '-9999px';
                document.body.appendChild(ta);
                ta.select();
                try { document.execCommand('copy'); done(); } catch (e) {}
                document.body.removeChild(ta);
            }
        };
    </script>
@endpush
