@extends('backend.layouts.manger')

@section('content')
    <div class="col-12">
        <div class="box">
            <div class="box-header with-border py-2">
                <h4 class="card-title">
                    <i class="fa fa-gears"></i>
                    {{ __('site.settings_title') }}
                </h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    @foreach (config('settings.manager_keys') as $key => $value)
                        <li class="nav-item fw-bolder">
                            <a class="nav-link @if ($loop->index == 0) active @endif"
                                id="{{ $key }}-tab" data-bs-toggle="tab"
                                href="#{{ $key }}" role="tab"
                                aria-controls="{{ $key }}" aria-expanded="true">
                                <span>
                                    <i class="{{ $value['icon'] }}"></i>
                                    {{ __('site.settings.manager_keys.' . $key) }}
                                </span>
                            </a>
                        </li>
                    @endforeach
                    <li class="nav-item dropdown hidden-sm-up">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <span>
                                <i class="fa fa-settings"></i>
                                {{ __('site.all_settings_title') }}
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            @foreach (config('settings.manager_keys') as $key => $value)
                                <a class="dropdown-item" id="{{ $key }}-tab"
                                    href="#{{ $key }}" role="tab" data-bs-toggle="tab"
                                    aria-controls="{{ $key }}">
                                    {{ __('site.settings.manager_keys.' . $key) }}
                                </a>
                            @endforeach
                        </div>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content tabcontent-border p-15" id="myTabContent">
                    @foreach (config('settings.manager_keys') as $key => $value)
                        <div role="tabpanel"
                            class="tab-pane fade @if ($loop->index == 0) show active @endif"
                            id="{{ $key }}" aria-labelledby="home-tab">
                            <p>
                          @if(!in_array($key,['restart_services','currency_converter','message_setting']))
                            <form class="SettingsForm"
                                action="{{ route('managers.settings.update', $key) }}" method="POST"
                                novalidate>
                                @csrf
                                @method('PUT')
                                <div class="box">
                                    <div class="box-body">
                                        @include("backend.settings.manager.{$key}", [
                                            'key' => $key,
                                        ])
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-success btn-rounded">
                                                {{ __('website.save') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @else
                              @include("backend.settings.manager.{$key}", [
                                  'key' => $key,
                              ])
                            @endif
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
@endsection

@push('scripts')
    @include('backend.includes.scripts.site_status_box')
    <script src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}">
    </script>
    <script
        src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/i18n/defaults-ar_AR.js') }}">
    </script>
    <script src="{{ asset('assets/functions.js') }}"></script>
    <script src="{{ asset('assets/settings.js') }}"></script>
@endpush
@push('livewire_scripts')
@endpush
