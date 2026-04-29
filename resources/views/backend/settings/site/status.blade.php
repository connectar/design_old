@extends('backend.layouts.manger')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="box bb-3 @if($mode) border-danger @else border-success @endif">
            <div class="box-header">
                <h4 class="box-title">@lang('website.website_status')</h4>
            </div>
            <div class="box-body text-center">
                @if($mode)
                <div>
                    <p>
                        <span class="h4">
                            @lang('website.website_status_work_off')
                            <i class="fa fa-fw fa-hotel text-danger" style="font-size: 25px"></i>
                        </span>
                    </p>
                </div>
                <div>
                    <a href="{{ route('managers.site.status') }}"
                        class="btn btn-rounded btn-success btn-md ml-5 changeSiteStatus">
                        @lang('website.button_mintainance_on')
                    </a>
                </div>
                @else
                <div>
                    <p>
                        <span class="h4">
                            @lang('website.website_status_work_on')
                            <i class="fa fa-fw fa-rocket text-success" style="font-size: 25px"></i>
                        </span>
                    </p>
                </div>
                <div>
                    <a href="{{ route('managers.site.status') }}"
                        class="btn btn-rounded btn-danger btn-md ml-5 changeSiteStatus">
                        @lang('website.button_mintainance_off')
                    </a>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{asset('assets/main_index.js')}}"></script>
@include('backend.includes.scripts.site_status_box')
@endpush
