

@extends('backend.layouts.livewire.cafe')


@section('content')

<livewire:ticket.user.show-ticket :ticket="$ticket" />
<livewire:ticket.user.ticket-replies :ticket='$ticket' />


@endsection
