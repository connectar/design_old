<div class="bg-white">
    <!-- Modal -->
    <div class="modal userOptionalBoxModal {{ $modalType }} fade" id="userOptionalBoxModal"
        tabindex="-1" data-focus="false">
        <div class="modal-dialog {{ $width }}">
            <div class="modal-content">
                <div class="modal-body no-padding">
                    @if ($componentName == $this->addDeviceModalComponent)
                        @livewire($this->addDeviceModalComponent)
                    @elseif($componentName == $this->showDeviceModalComponent)
                        @livewire($this->showDeviceModalComponent)
                    @elseif($componentName == $this->showBroadbandDeviceModalComponent)
                        @livewire($this->showBroadbandDeviceModalComponent)
                    @elseif($componentName == $this->updateDeviceModalComponent)
                        @livewire($this->updateDeviceModalComponent)
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->
</div>
