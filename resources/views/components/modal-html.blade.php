<!-- Modal -->
<div class="modal center-modal {{ $modalId }} fade" id="{{$modalId}}" tabindex="-1" data-focus="false">
    <div class="modal-dialog {{ $width }}">
        <div class="modal-content">
            <div class="modal-body no-padding">
                {{$slot}}
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
