@extends('backend.layouts.manger')

@section('content')
  <livewire:ticket.user.show-ticket :ticket="$ticket"  />
  <livewire:ticket.user.ticket-replies :ticket='$ticket' />
  <livewire:ticket.support.create-ticket-reply-form :ticket="$ticket"  />

@endsection
