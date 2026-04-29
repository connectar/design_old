@extends('frontend.layouts.home')

@section('content')
    <section id="plans" class="bg-lightest pb-100" style="margin-top: 125px">

        @include('frontend.includes.plan_header')

        <div class="container">
            <div class="row mt-30 align-items-center bg-lightest p-20">
                <div class="row g-1 text-center text-danger justify-content-center">
                    @foreach ($plans as $plan)
                        @include('frontend.includes.' . $view)
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
