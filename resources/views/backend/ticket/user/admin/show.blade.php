
@extends('backend.layouts.livewire.admin')


@section('content')

<livewire:ticket.user.show-ticket :ticket="$ticket" />
<livewire:ticket.user.ticket-replies :ticket='$ticket' />

@endsection
