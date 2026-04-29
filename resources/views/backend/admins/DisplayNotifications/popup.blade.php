@if ($popup_message_panel = getMessagePanel(\App\ENUMS\MessagePanelEnum::POPUP))
    <?php
    $popup_ids = $popup_message_panel->pluck('id')->toArray();
    $count_read_message = \App\Models\ReadMessage::query()
        ->whereIn('message_panel_id', $popup_ids)
        ->where('admin_id', auth()->id())
        ->count();
    ?>
    @if ($count_read_message != count($popup_ids))
        <div class="notify_sec">
            @foreach ($popup_message_panel as $item)
                @if (!isAdminReadMessagePanel($item->id))
                    <div class="notify_popup">
                        <form action="{{ route('admins.accept.message.panel') }}" method="post">
                            @csrf
                            @method('POST')
                            <input type="hidden" value="{{ $item->id }}" name="id">
                            <div class="box mb-0">
                                <div class="box-body ribbon-box">
                                    <div class="ribbon-two ribbon-two-danger"><span>إشعار</span></div>
                                    <p class="mb-2 text-center text-white">
                                        <span class="text-primary fs-20">{{ $item->subject }}</span>
                                    <div class="text-center"><span>{{ $item->message }}</span></div>
                                    </p>
                                </div>
                            </div>
                            <div class="p-3" style="text-align: left">
                                <button class="btn btn-danger">نعم , لقد قرأت هذا</button>
                            </div>
                        </form>
                    </div>
                    @break
                @endif
            @endforeach
        </div>
    @endif
@endif
