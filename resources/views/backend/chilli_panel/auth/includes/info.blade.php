<div class="text-center mb-2 fs-18 text-success">
    {{ __('site.coova_messages_error.' . $data['res']) }}
</div>
@if (count($drinks) > 0)
    @include('backend.chilli_panel.auth.includes.drinks')
@endif
