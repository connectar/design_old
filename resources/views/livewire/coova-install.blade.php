<div class="row">
    @if ($nasNotExists)
        <div class="box bt-3 border-primary text-center">
            <div class="box-body py-50">
                <span class="d-block text-center text-danger">
                    <i class="fa fa-close fs-30"></i>
                </span>
                <span class="fw-bold text-primary fs-18">
                    {{ __('site.replay_messages.errors.nas_not_exists') }}
                </span>
                <span class="d-block mt-3">
                    <a href="{{ route('admins.nas.index') }}" class="btn btn-success btn-round">
                        {{ __('site.errors_pages.back_to_nas') }}
                    </a>
                </span>
            </div>
        </div>
    @else
        <div class="col-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    @foreach ($tabs as $tab)
                        <li>
                            <a href="#{{ $tab }}" data-bs-toggle="tab"
                                @if ($tab == $activeTab) class="active" @endif>
                                {{ __('site.nas_install.' . $tab . '_title') }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content">
                    @foreach ($tabs as $tab)
                        <div class="tab-pane @if ($activeTab == $tab) active @endif"
                            id="{{ $tab }}">
                            @include('backend.admins.nas.includes.coova_install.' . $tab)
                        </div>
                    @endforeach
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
    @endif
</div>
