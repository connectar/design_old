<div>
    <div>
        <form method="post" wire:submit='showDeletedBox'>
            @csrf
            <button class="btn btn-danger" type="submit" wire:submit="showDeletedBox">
                <i class="fa fa-exclamation-triangle alert-icon mx-2 fa-x"></i>
                {{ __('alerts.services_restart.title') }}
            </button>
        </form>
        <p class="p-2 pb-1 mt-4">
            {{ __('new_trans.restart_services.file_path') }} :
            {{ config('system_services.restart_services.file_path') }}
        </p>
        <p class="p-2 pt-1">
            {{ __('new_trans.restart_services.info_text') }}
        </p>
    </div>
    <br>
    <hr>
    <br>
    <div x-data="confirmComponent" class="my-4">
        <button class="btn btn-primary" type="submit" x-on:click="confirm()">
            <i class="fa fa-rotate-left alert-icon mx-2 fa-x"></i>
            {{ __('alerts.reinstall_system.title') }}
        </button>
    </div>
    <p class="p-2 pt-1">
        {{ __('alerts.reinstall_system.info_text') }}
    </p>
</div>

@push('scripts')
    <script>
        function confirmComponent() {
            return {
                confirm() {
                    let title = "هل انت متأكد من انك تريد اعادة تركيب السيستم علي جميع السيرفرات ؟";
                    let text = "سوف يتم اعادة تركيب جميع السيرفرات عند التأكيد";
                    confirmWarningAlert(title, text, 'تأكيد').then((result) => {
                        if (result.isConfirmed) {
                            @this.call('reinstallSystemOnAllNasServers')
                        }
                    });
                }
            };
        }
    </script>
@endpush
