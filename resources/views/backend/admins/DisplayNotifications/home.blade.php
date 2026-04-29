@foreach(getMessagePanel(\App\ENUMS\MessagePanelEnum::HOME) as $item)
    <div class="box">
        <div class="box-body ribbon-box">
            <div class="ribbon-two ribbon-two-danger"><span>إشعار</span></div>
            <p class="mb-2 text-center text-white">
                <span class="text-primary fs-20">{{$item->subject}}</span>
            <div class="text-center"><span>{!! nl2br(e($item->message)) !!}</span></div>
            </p>
        </div>
    </div>
@endforeach
