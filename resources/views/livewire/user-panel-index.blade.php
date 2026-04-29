<div>
    <x-datatable.loading />
    <div class="row">
        <div class="col-12">
            <div class="py-0">
                <div class="box-header no-border">
                    <h6 class="box-title text-white">
                        {{ __('site.user_panel.wellcome') }}
                        <span class="text-white">
                            {{ $user->fullname }}
                        </span>
                    </h6>
                    <span class="pull-right">
                        @if (is_null($userUptime))
                            <span class="badge fw-bold px-4">
                                <i class="fa fa-circle text-danger"></i>
                                {{ __('adding.user.offline') }}
                            </span>
                        @else
                            <span class="badge fw-bold px-4" style="background-color: rgb(27, 170, 27)">
                                <i class="fa spi fa-snowflake-o fa-spin" style="color: greenyellow"></i>
                                {{ __('adding.user.online') }}
                            </span>
                            <span class="badge badge-lg d-block text-white">
                                <i class="fa fa-clock-o text-white"></i>
                                {{ $userUptime }}
                            </span>
                        @endif
                    </span>
                </div>
            </div>
        </div>
        {{-- Payment Alerts Section --}}
        @if (count($paymentAlerts) > 0 || count($permanentAlerts) > 0)
            <div class="row mb-4">
                <div class="col-12">
                    {{-- Payment Due Alerts --}}
                    @foreach ($paymentAlerts as $alert)
                        <div class="alert alert-dismissible fade show shadow border-0 mb-3" role="alert"
                            style="background: linear-gradient(135deg, 
                            @if ($alert['type'] === 'warning') #fff3cd 0%, #fffbea 100%
                            @elseif($alert['type'] === 'danger') #f8d7da 0%, #ffe5e7 100%
                            @elseif($alert['type'] === 'success') #d1e7dd 0%, #e8f5e9 100%
                            @else #cff4fc 0%, #e7f6fd 100% @endif); 
                            border-right: 5px solid 
                            @if ($alert['type'] === 'warning') #ff9800
                            @elseif($alert['type'] === 'danger') #f44336
                            @elseif($alert['type'] === 'success') #4caf50
                            @else #2196f3 @endif !important;
                            padding: 1.5rem;">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0 me-3 ms-2">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 60px; height: 60px; background-color: 
                                        @if ($alert['type'] === 'warning') #ff9800
                                        @elseif($alert['type'] === 'danger') #f44336
                                        @elseif($alert['type'] === 'success') #4caf50
                                        @else #2196f3 @endif;">
                                        <i
                                            class="fa fa-2x text-white
                                        @if ($alert['type'] === 'warning') fa-exclamation-triangle
                                        @elseif($alert['type'] === 'danger') fa-exclamation-circle
                                        @elseif($alert['type'] === 'success') fa-check-circle
                                        @else fa-info-circle @endif">
                                        </i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 pt-1">
                                    <h4 class="alert-heading fw-bold mb-3"
                                        style="font-size: 1.4rem; color: 
                                    @if ($alert['type'] === 'warning') #e65100
                                    @elseif($alert['type'] === 'danger') #c62828
                                    @elseif($alert['type'] === 'success') #2e7d32
                                    @else #1565c0 @endif;">
                                        {{ $alert['title'] }}
                                    </h4>
                                    <p class="mb-3" style="font-size: 1.1rem; line-height: 1.6; color: #333;">
                                        {{ $alert['message'] }}
                                    </p>
                                    <div class="d-flex align-items-center mt-3 pt-3 border-top"
                                        style="border-color: rgba(0,0,0,0.1) !important;">
                                        <i class="fa fa-calendar mx-2"
                                            style="color: 
                                        @if ($alert['type'] === 'warning') #f57c00
                                        @elseif($alert['type'] === 'danger') #d32f2f
                                        @elseif($alert['type'] === 'success') #388e3c
                                        @else #1976d2 @endif; font-size: 1.1rem;"></i>
                                        <span style="font-size: 1rem; color: #555;">
                                            <strong>موعد التجديد:</strong> {{ $renewDate }} ({{ $renewInDayes }})
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endforeach

                    {{-- Permanent Alerts --}}
                    @foreach ($permanentAlerts as $alert)
                        <div class="alert alert-dismissible fade show shadow border-0 mb-3" role="alert"
                            style="background: linear-gradient(135deg, 
                            @if ($alert['type'] === 'warning') #fff3cd 0%, #fffbea 100%
                            @elseif($alert['type'] === 'danger') #f8d7da 0%, #ffe5e7 100%
                            @elseif($alert['type'] === 'success') #d1e7dd 0%, #e8f5e9 100%
                            @else #cff4fc 0%, #e7f6fd 100% @endif); 
                            border-right: 5px solid 
                            @if ($alert['type'] === 'warning') #ff9800
                            @elseif($alert['type'] === 'danger') #f44336
                            @elseif($alert['type'] === 'success') #4caf50
                            @else #2196f3 @endif !important;
                            padding: 1.5rem;">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0 me-3 ms-2">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 60px; height: 60px; background-color: 
                                        @if ($alert['type'] === 'warning') #ff9800
                                        @elseif($alert['type'] === 'danger') #f44336
                                        @elseif($alert['type'] === 'success') #4caf50
                                        @else #2196f3 @endif;">
                                        <i
                                            class="fa fa-2x text-white
                                        @if ($alert['type'] === 'warning') fa-exclamation-triangle
                                        @elseif($alert['type'] === 'danger') fa-exclamation-circle
                                        @elseif($alert['type'] === 'success') fa-check-circle
                                        @else fa-info-circle @endif">
                                        </i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 pt-1">
                                    <h4 class="alert-heading fw-bold mb-3"
                                        style="font-size: 1.4rem; color: 
                                    @if ($alert['type'] === 'warning') #e65100
                                    @elseif($alert['type'] === 'danger') #c62828
                                    @elseif($alert['type'] === 'success') #2e7d32
                                    @else #1565c0 @endif;">
                                        {{ $alert['title'] }}
                                    </h4>
                                    <p class="mb-2" style="font-size: 1.1rem; line-height: 1.6; color: #333;">
                                        {{ $alert['message'] }}
                                    </p>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="py-0">
                    <div class="box">

                        <div class="box-body text-center py-1">
                            <a href="https://www.google.com" target="__blank__"
                                class="text-white waves-effect btn btn-social-icon btn-instagram mt-1">
                                <i class="fa fa-google"></i>
                                <span class="badge d-block">
                                    جوجل
                                </span>
                            </a>
                            <a href="https://www.facebook.com" target="__blank__"
                                class="text-white waves-effect waves-white btn btn-social-icon btn-facebook mt-1">
                                <i class="fa fa-facebook"></i>
                                <span class="badge d-block">
                                    فيس بوك
                                </span>
                            </a>
                            <a href="https://www.youtube.com" target="__blank__"
                                class="text-white waves-effect  btn btn-social-icon btn-youtube mt-1">
                                <i class="fa fa-youtube-play"></i>
                                <span class="badge d-block">
                                    يوتيوب
                                </span>
                            </a>
                            @if (isset($panelSetting['show_magazine']) && $panelSetting['show_magazine'] == true)
                                <a href="http://{{ $panelSetting['magazine_url'] ?? '10.0.0.3' }}" target="__blank__"
                                    class="text-white waves-effect  btn btn-social-icon btn-vk mt-1">
                                    <i class="fa fa-cloud-download"></i>
                                    <span class="badge d-block">
                                        المجلة
                                    </span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @if ($authIsUser)
                <div class="col-md-6">
                    <div class="box bg-success bg-hover-danger">
                        <div class="box-body">
                            <div class="text-white fw-600 fs-18 mb-2 mt-5">
                                {{ __('site.user_panel.account') }}
                            </div>
                            <div class="text-white fs-20">
                                {{ $user->render()->account() }}
                            </div>

                            <div class="pt-3 mx-auto">
                                <button class="btn btn-dark"
                                    wire:click="$dispatch('chargeUserAccount','{{ $user->id }}')">
                                    {{ __('site.user_panel.charge') }}
                                </button>
                                <button class="btn btn-secondary"
                                    wire:click="$dispatch('showUserInvoices','{{ $user->id }}')">
                                    {{ __('site.user_panel.invoice_log') }}
                                </button>
                                <span class="text-white icon-Cart2 fs-40 pull-right d-none d-sm-block">
                                    <i class="fa fa-money"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box bg-danger bg-hover-danger">
                        <div class="box-body">
                            <div class="text-white fw-600 fs-18 mb-2 mt-5">
                                {{ __('site.user_panel.debt_price') }}
                            </div>
                            <div class="text-white fs-20">
                                {{ $debtInvoices . ' جنيه' }}
                            </div>

                            <div class="pt-3 mx-auto">
                                <span class="text-white icon-Cart2 fs-40 pull-right d-none d-sm-block">
                                    <i class="fa fa-close"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
        <div class="row">
            <!-- col -->
            <div class="col-md-6">
                <div class="box">
                    <div class="box-body">
                        <div class="box-header no-border p-0">
                            <h4 class="box-title">
                                {{ __('site.user_panel.usage') }}
                                <span
                                    class="text-{{ __('site.user_panel.using_now_color.' . $qutaInfo['using_now']) }}">
                                    {{ __('site.user_panel.using_now.' . $qutaInfo['using_now']) }}
                                </span>
                            </h4>
                            <button class="btn btn-sm btn-danger-light pull-right d-none d-sm-block"
                                wire:click="$dispatch('showQutaUsage','{{ $user->id }}','{{ $user->getType() }}')">
                                {{ __('site.user_panel.usage_log') }}
                            </button>
                        </div>
                        <div class="text-center mb-2">
                            <input class="knob" data-width="140" data-height="140" data-step="1" data-min="0"
                                data-max="100" data-linecap="round" data-fgColor="{{ $qutaInfo['progress_color'] }}"
                                value="{{ $qutaInfo['remain'] }}" data-skin="tron" data-angleOffset="180"
                                data-readOnly="true" data-thickness=".1" />
                        </div>
                        @if ($showOfferInfo)
                            <div class="row">
                                <div class="col">
                                    <span class="badge badge-danger p-2"></span>
                                    <span>
                                        {{ __('site.user_panel.quta_usage') }}
                                    </span>
                                    <span dir="auto">{{ $qutaInfo['usage'] }}</span>
                                </div>
                                <div class="col">
                                    <span class="badge badge-success p-2"></span>
                                    <span>
                                        {{ __('site.user_panel.quta_remain') }}
                                    </span>
                                    <span dir="auto">{{ $qutaInfo['remaining_value'] }}</span>
                                </div>
                                <div class="col-12 mt-1">
                                    <span class="badge badge-primary p-2"></span>
                                    <span>
                                        {{ __('site.user_panel.quta_total') }}
                                    </span>
                                    <span dir="auto">{{ $qutaInfo['total'] }}</span>
                                </div>
                            </div>
                            @if ($authIsUser)
                                <div class="text-center mt-3">
                                    <button class="btn btn-sm btn-success" wire:click="$dispatch('AddQutaByUser')">
                                        {{ __('site.user_panel.add_quta_button') }}
                                    </button>
                                    <button class="btn btn-sm btn-danger-light d-inline d-sm-none mx-2"
                                        wire:click="$dispatch('showQutaUsage','{{ $user->id }}','{{ $user->getType() }}')">
                                        {{ __('site.user_panel.usage_log') }}
                                    </button>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header no-border">
                        <h4 class="box-title">
                            {{ __('site.user_panel.offer_info') }}
                        </h4>
                        @if ($authIsUser)
                            <button class="btn btn-sm btn-danger-light pull-right"
                                wire:click="$dispatch('AddQutaByUser')">
                                {{ __('site.user_panel.add_quta_button') }}
                            </button>
                        @endif
                    </div>
                    <div class="box-body">
                        <div class="py-1">
                            <table class="table no-border table-striped">
                                <tr>
                                    <td class="py-1">
                                        {{ __('site.user_panel.offer_name') }}
                                    </td>
                                    <td class="py-1">
                                        <span class="badge badge-primary">
                                            {{ $offer->name }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-1">
                                        {{ __('site.user_panel.offer_price') }}
                                    </td>
                                    <td class="py-1">
                                        <span class="badge badge-danger">
                                            {{ $offer->render()->price() }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ __('site.user_panel.renew_data') }}
                                    </td>
                                    <td>
                                        {{ $renewDate }}
                                        {{ __('site.user_panel.mm') }}
                                        {{ $renewInDayes }}
                                    </td>
                                </tr>
                                @if (auth('user')->check())
                                    <tr>
                                        <td>{{ __('user_renew_dates.auto_renew_txt') }}</td>
                                        <td>
                                            <form method="post" action="{{ route('users.auto_renew') }}"
                                                class="form-inline">
                                                @csrf
                                                @method('POST')
                                                <div class="row">
                                                    <div class="col-9">
                                                        <select class="form-control" name="auto_renew"
                                                            style="width: 100% !important;">
                                                            @if (\Illuminate\Support\Facades\Auth::user()->auto_renew == 0)
                                                                <option value="0" selected="selected">
                                                                    {{ __('user_renew_dates.auto_renew_0') }}</option>
                                                                <option value="1">
                                                                    {{ __('user_renew_dates.auto_renew_1') }}</option>
                                                            @else
                                                                <option value="0">
                                                                    {{ __('user_renew_dates.auto_renew_0') }}</option>
                                                                <option value="1" selected="selected">
                                                                    {{ __('user_renew_dates.auto_renew_1') }}</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-3">
                                                        <button
                                                            class="btn btn-sm btn-success btn-block">{{ __('user_renew_dates.save_btn') }}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        @if ($showOfferInfo && $authIsUser)
                            <div class="text-center">
                                <button class="btn btn-sm btn-block btn-success" wire:click="$dispatch('RenewFromPanel')">
                                    {{ __('site.user_panel.renew') }}
                                </button>
                                <button class="btn btn-sm btn-success-light mx-3"
                                    wire:click="$dispatch('changeOfferByUser')">
                                    {{ __('site.user_panel.change_offer') }}
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- /col -->
        </div>
        <div class="row">
            <div class="col-12">
                <div class="box bg-bubbles-dark bg-dark">
                    <div class="box-header no-border text-center">
                        <h4 class="box-title">
                            اعلان مبوب
                        </h4>
                    </div>
                    <div class="box-body text-center">
                        <h1 class="fs-22">محتوى الاعلان</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
