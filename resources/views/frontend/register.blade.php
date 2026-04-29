@extends('frontend.layouts.home')

@section('content')
    <section id="plans" class=" pb-100" style="margin-top: 70px;background-color:#1f1f1f;color:white;">
        {{-- @include('frontend.includes.register_header') --}}
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="box">
                        <div class="box-body">
						@include('frontend.includes.register_info') 

                            <form id="FormSubmit" action="{{ route('home.register_store'),$plan->id) }}"
                                method="POST" dir="auto">
                                @csrf
                                @method('POST')
                                <input class="form-control" type="hidden" name="network[plan_id]"
                                    value="{{ $plan->id }}" id="plan_id">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="network_name">
                                                @lang('adding.register.network_name')</label>
                                            <div>
                                                <input class="form-control" type="text"
                                                    name="network[name]" placeholder="@lang('adding.register.network_name_placeholder')"
                                                    id="network_name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label>
                                                @lang('adding.register.network_using')
                                            </label>
                                            <div>
                                                <select class="form-control" name="network[using]"
                                                    disabled>
                                                    @foreach ($network_using as $key => $value)
                                                        <option value="{{ $key }}"
                                                            @if ($key == 'cafe' && $plan->type == 2) selected @endif>
                                                            {{ $value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label>
                                                @lang('adding.register.country')</label>
                                            <div>
                                                <select class="form-control" name="network[country_id]"
                                                    id="country_id">
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country['id'] }}">
                                                            {{ $country['name'] }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row" id="governorates">
                                            <label>
                                                @lang('adding.register.governorate')</label>
                                            <div>
                                                <select class="form-control"
                                                    name="network[governorate_id]" id="governorate_id">
                                                    @foreach ($governorates as $governorate)
                                                        <option value="{{ $governorate['id'] }}">
                                                            {{ $governorate['name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="admin_name">@lang('adding.register.admin_name')</label>
                                            <div>
                                                <input class="form-control" type="text"
                                                    placeholder="@lang('adding.register.admin_name_placeholder')"
                                                    name="admin[fullname]" id="admin_name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="admin_username">@lang('adding.register.admin_username')</label>
                                            <div>
                                                <input class="form-control" type="text"
                                                    placeholder="@lang('adding.register.admin_username_placeholder')" name="admin[name]"
                                                    id="admin_username">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        {{-- admin password --}}
                                        <div class="form-group row">
                                            <label for="admin_password">@lang('adding.register.admin_password')</label>
                                            <div>
                                                <input class="form-control" type="password"
                                                    name="admin[password]" id="admin_password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="admin_password2">@lang('adding.register.admin_password2')</label>
                                            <div>
                                                <input class="form-control" type="password"
                                                    name="password_confirmation" id="admin_password2">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="admin_email">@lang('adding.register.admin_email')</label>
                                            <div>
                                                <input class="form-control" type="email"
                                                    placeholder="@lang('adding.register.admin_email_placeholder')" name="admin[email]"
                                                    id="admin_email">
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="admin_phone">@lang('adding.register.admin_phone')</label>
                                            <div>
                                                <input class="form-control" type="text"
                                                    placeholder="@lang('adding.register.admin_phone_placeholder')" name="admin[phone]"
                                                    id="admin_phone">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        {{-- admin phone_other --}}
                                        <div class="form-group row">
                                            <label for="admin_phone_other">@lang('adding.register.admin_phone_other')</label>
                                            <div>
                                                <input class="form-control" type="text"
                                                    placeholder="@lang('adding.register.admin_phone_other_placeholder')"
                                                    name="admin[other_phone]" id="admin_phone_other">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- admin section --}}
                                {{-- captcha --}}
                                {{-- <div class="form-group row">
                                    <label for="captcha"
                                    >@lang('adding.register.captcha')</label>
                                    <div>
                                        <div class="row">
                                            <div class="col">
                                                <input class="form-control" type="text" name="captcha" id="captcha">
                                            </div>
                                            <div class="col">
                                                <img id ="captcha_image" src="{{ captcha_src('flat') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="row" dir="ltr">
                                    <div class="col">
                                        <button type="submit" class="btn btn-success">
                                            @lang('website.register')</button>
                                        <a href="{{ route('home.main') }}"
                                            class="btn btn-dark text-primary">
                                            @lang('website.back')</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    @include('sweetalert::alert')
    @include('backend.includes.scripts.main_js')
@endpush
