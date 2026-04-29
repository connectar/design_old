<div class="bg-white">
    <!-- Modal -->
    <div class="modal userOptionalBoxModal {{ $modalType }} fade" id="userOptionalBoxModal"
        tabindex="-1" data-focus="false">
        <div class="modal-dialog {{ $width }}">
            <div class="modal-content">
                <div class="modal-body no-padding">
                    @if ($componentName == 'add-device')
                        @livewire('add-device')
                    @elseif($componentName == 'show-device')
                        @livewire('show-device')
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->
</div>
