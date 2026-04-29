
@extends('frontend.theme_two.master')

@section('content')

    <section id="custom-plans">

        <div id="custom-plans-container"  >
            <div>
                <div style="color: #1f1f1f;">
                    <div >
                        <div class="custom-box-body">
							@include('frontend.theme_two.includes.register_info')

						<div style="padding-top:50px;" >
                                <div >
                           <form id="FormSubmit" action="{{ route('theme_two.home.register_store',$plan->id) }}" method="POST" dir="auto">
                                @csrf

                                <input class="custom-form-control" type="hidden" name="network[plan_id]"
                                    value="{{ $plan->id }}" id="plan_id">


                                <div class="grid-container"  style="gap: 15px 50px;" >
                                    <div class="input-container" >
                                            <input class="custom-input "
                                                    name="network[name]" placeholder="{{trans('adding.register.network_name_placeholder')}}"
                                                    id="network_name">
                                            <label class="custom-label" for="network_name" >
                                            @lang('adding.register.network_name')</label>
											@error('network.name')
												<span class="custom-error">{{ $message }}</span>
											@enderror
                                    </div>

                                    <div>
                                        <div class="input-container">
                                            <select class="custom-input" style="padding:0px;padding-top:8px;padding-bottom:8px;" name="network[using]" disabled>
                                                @foreach ($network_using as $key => $value)
                                            <option value="{{ $key }}" @if ($key == 'cafe' && $plan->type == 2) selected @endif>
                                              {{ $value }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label class="custom-label">
                                          @lang('adding.register.network_using')
                                        </label>
											@error('network.using')
												<span class="custom-error">{{ $message }}</span>
											@enderror
                                        </div>
                                      </div>

                                        <div class="input-container" id="countryContainer">
                                            <select class="custom-input" style="padding:0px;padding-top:8px;padding-bottom:8px;"
                                           name="network[country_id]" id="country_id">
                                            @foreach ($countries as $country)
                                            <option value="{{ $country['id'] }}">
                                              {{ $country['name'] }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label class="custom-label">
                                          @lang('adding.register.country')
                                        </label>
											@error('network.country_id')
												<span class="custom-error">{{ $message }}</span>
											@enderror
                                        </div>

                                      <div class="custom-col-md-6" id="governorateContainer">
                                        <div class="input-container">
                                            <select class="custom-input" style="padding:0px;padding-top:8px;padding-bottom:8px;"
                                           name="network[governorate_id]" id="governorate_id">
                                            @foreach ($governorates as $governorate)
                                            <option value="{{ $governorate['id'] }}">
                                              {{ $governorate['name'] }}
                                            </option>
                                            @endforeach
                                          </select>
                                            <label class="custom-label">
                                              @lang('adding.register.governorate')
                                            </label>
											@error('network.governorate_id')
												<span class="custom-error">{{ $message }}</span>
											@enderror
                                        </div>
                                      </div>
                                        <div class="input-container">
                                                <input class="custom-input"
                                                placeholder="@lang('adding.register.admin_name_placeholder')"
                                                    name="admin[fullname]" id="admin_name">
                                            <label class="custom-label" for="admin_name">@lang('adding.register.admin_name')</label>
											@error('admin.fullname')
												<span class="custom-error">{{ $message }}</span>
											@enderror
										</div>
                                        <div class="input-container">
                                                <input class="custom-input"
                                                    placeholder="@lang('adding.register.admin_username_placeholder')" name="admin[name]"
                                                    id="admin_username">
                                            <label class="custom-label" for="admin_username">@lang('adding.register.admin_username')</label>
											@error('admin.username')
												<span class="custom-error">{{ $message }}</span>
											@enderror
                                        </div>
                                        {{-- admin password --}}
                                        <div class="input-container">
                                            <input class="custom-input" placeholder name="admin[password]" id="admin_password" type="password">
                                            <label class="custom-label"  for="admin_password">@lang('adding.register.admin_password')</label>
											@error('admin.password')
												<span class="custom-error">{{ $message }}</span>
											@enderror
                                        </div>
                                        <div class="input-container">
                                            <input class="custom-input" placeholder name="password_confirmation" id="admin_password2" type="password">
                                            <label class="custom-label"  for="admin_password2">@lang('adding.register.admin_password2')</label>
											@error('password_confirmation')
												<span class="custom-error">{{ $message }}</span>
											@enderror                                        </div>
                                    {{-- <div class="custom-col-md-6">
                                        <div class="custom-form-group custom-row">
                                            <label  for="admin_email">@lang('adding.register.admin_email')</label>
                                            <div>
                                                <input class="custom-form-control" type="email"
                                                    placeholder="@lang('adding.register.admin_email_placeholder')" name="admin[email]"
                                                    id="admin_email">
                                            </div>
                                        </div>
                                    </div> --}}
                                        <div class="input-container">
                                                <input class="custom-input"
                                                    placeholder="@lang('adding.register.admin_phone_placeholder')" name="admin[phone]"
                                                    id="admin_phone">
												<label class="custom-label"  for="admin_phone">@lang('adding.register.admin_phone')</label>
											@error('admin.phone')
												<span class="custom-error">{{ $message }}</span>
											@enderror
                                        </div>
                                        {{-- admin phone_other --}}
                                        <div class="input-container">
                                                <input class="custom-input"
                                                    placeholder="@lang('adding.register.admin_phone_other_placeholder')"
                                                    name="admin[other_phone]" id="admin_phone_other">
                                                <label class="custom-label"  for="admin_phone_other">@lang('adding.register.admin_phone_other')</label>
											@error('admin.other_phone')
												<span class="custom-error">{{ $message }}</span>
											@enderror
										</div>
                                {{-- admin section --}}
                                {{-- captcha --}}
                                {{-- <div class="custom-form-group custom-row">
                                    <label  for="captcha"
                                    >@lang('adding.register.captcha')</label>
                                    <div>
                                        <div class="custom-row">
                                            <div class="col">
                                                <input class="custom-form-control" type="text" name="captcha" id="captcha">
                                            </div>
                                            <div class="custom-col">
                                                <img id ="captcha_image" src="{{ captcha_src('flat') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                                <div style="margin-top: 30px;" dir="{{ app()->getLocale() == 'ar' ? 'ltr' : 'rtl' }}">
                                    <div class="col">
                                        <button type="submit" class="btn-success" style="font-family:changa;border-radius:5px;padding:15px;width:150px;">
                                            @lang('website.register')
                                        </button>
                                        <a href="{{ route('theme_two.home.main') }}"
                                            class="btn " style="padding: 15px;margin-left:10px;margin-right:10px;" >
                                            @lang('website.back')</a>
                                    </div>
                                </div>
                            </form>
                                </div>
							<div>

                        </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('styles')
	<style>
	.custom-error
	{
		color:red;
		font-size:14px;
		display:flex;
		padding:4px;
	}
  .grid-container {
    display: grid;
    gap: 20px; /* Adjust the gap between columns */
  }

  @media (min-width: 768px) {
    .grid-container {
      grid-template-columns: 1fr 1fr;
    }
  }

  /* Basic reset and styling */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  /* Styling for input container */
  .input-container {
    display: inline-block;
    position: relative;
    width: 100%;
  }

  /* Styling for input element */
  .custom-input {
    width: 280px;
    padding: 10px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    height: 45px !important;
    font-family: changa;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  }


  /* Styling for input label */
  .custom-label {
    position: absolute;
    top: -8px;
    left: 10px;
    background-color: #ffffff;
    padding: 0 5px;
    font-size: 14px;
    color: #999;
    transition: transform 0.2s ease-out, font-size 0.2s ease-out;
  }

  /* Input focus styles */
  .custom-input:focus {
    border-color: #80bdff;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
  }

  /* Input label animation on focus */
  .custom-input:focus + .custom-label,
  .custom-input:not(:placeholder-shown) + .custom-label {
    transform: translateY(-10px);
    font-size: 12px;
    background-color: #ffffff;
  }


#custom-plans
{
	padding-top: 30px;
	padding-bottom:30px;
	min-height:77vh;
	background-color:#e9c12a;
	color:white;
}

#custom-plans-container
{
	background-color:white;
	padding:40px;
	padding-top:60px;
	padding-bottom:60px;
	max-width:60%;
	display:flex;
	justify-content:center;
	margin:auto;
	border-radius:10px;
	box-shadow: -10px 10px 15px rgba(0, 0, 0, 0.2);
}

 @media (max-width: 768px) {
 .custom-input {
    width: 100%;
 }

 #custom-plans-container
 {
	 max-width:95%;
	 width:full;
 }

 }

</style>


@endpush


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var countrySelect = document.getElementById('country_id');
        var countryContainer = document.getElementById('countryContainer');
        var governorateContainer = document.getElementById('governorateContainer');

        // Hide the country select input and its container initially
        countryContainer.style.display = 'block';

        // Add change event listener to the country select input
        countrySelect.addEventListener('change', function() {
            // If the selected country is Egypt, show the country select input and its container
            if (this.value === '1') {
                countryContainer.style.display = 'block';
                governorateContainer.style.display = 'block';
            } else {
                // Otherwise, hide the country select input and its container
                countryContainer.style.display = 'block';
                governorateContainer.style.display = 'none';
            }
        });
    });
</script>
    @include('sweetalert::alert')
    @include('backend.includes.scripts.main_js')
@endpush
