@extends('backend.layouts.dashboard')

@section('header')
    @include('backend.includes.admin_header')
@endsection
@section('menu')
    @if (authIsAdmin())
        @include('backend.includes.admin_menu')
    @elseif (authIsDistributer())
        @include('backend.includes.distributer_menu')
    @elseif (authIsCafeAdmin())
        @include('backend.includes.cafe_menu')
    @elseif(authIsCafeHomeAdmin())
        @include('backend.includes.cafe_home_menu')
    @elseif(authIsCafeBranchAdmin())
        @include('backend.includes.cafe_branch_menu')
    @else
        @include('backend.includes.distributer_menu')
    @endif
@endsection
