@extends('backend.layouts.manger')

@section('content')
    <div class="col-12">
        <div class="box">
            <div class="box-header with-border py-2">
                <h4 class="card-title">
                    <i class="fa fa-link"></i>
                    {{ __('customer_migration.pairing_edit_title') }}
                </h4>
            </div>
            <div class="box-body">
                <p class="text-muted">{{ __('customer_migration.pairing_edit_intro') }}</p>
                <p>
                    <a href="{{ route('managers.settings.customer-migration') }}" class="btn btn-default btn-sm">
                        ← {{ __('customer_migration.back_to_hub') }}
                    </a>
                </p>

                @if (session('pairing_saved_ok'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-bs-dismiss="alert">&times;</button>
                        <strong>{{ __('customer_migration.pairing_saved_title') }}</strong>
                        <p class="mb-0">{{ __('customer_migration.pairing_saved_detail') }}</p>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-warning">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="alert alert-warning">
                    <i class="fa fa-database"></i> {{ __('customer_migration.pairing_db_only_warning') }}
                </div>

                <form method="post" action="{{ route('managers.settings.customer-migration.pairing') }}">
                    @csrf
                    <div class="form-group">
                        <label for="legacy_server_url">
                            <i class="fa fa-cloud-download"></i>
                            {{ __('customer_migration.legacy_server_url_label') }}
                        </label>
                        <input type="url" name="legacy_server_url" id="legacy_server_url" class="form-control" dir="ltr"
                            value="{{ $legacyServerUrlInput }}" required autocomplete="off"
                            placeholder="https://old.example.com">
                        <small class="text-muted">{{ __('customer_migration.legacy_server_url_help') }}</small>
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fa fa-lock"></i>
                            {{ __('customer_migration.new_domain_label') }}
                        </label>
                        <input type="text" class="form-control" dir="ltr" readonly
                            value="{{ $effectiveNewSystemDomain !== '' ? $effectiveNewSystemDomain : __('customer_migration.pairing_not_set') }}">
                        <small class="text-muted d-block mt-1">
                            <i class="fa fa-info-circle"></i>
                            {{ __('customer_migration.new_domain_auto_from_general') }}
                            <a href="{{ route('managers.settings') }}#general" target="_blank" rel="noopener">
                                {{ __('customer_migration.open_general_settings') }}
                            </a>
                        </small>
                    </div>

                    <div class="well well-sm mb-3" dir="ltr">
                        <strong>{{ __('customer_migration.legacy_export_full_url_label') }}</strong>
                        <div><code>{{ $effectiveLegacyExportUrl !== '' ? $effectiveLegacyExportUrl : __('customer_migration.pairing_not_set') }}</code></div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> {{ __('customer_migration.pairing_save') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
