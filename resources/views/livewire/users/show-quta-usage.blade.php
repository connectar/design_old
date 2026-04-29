<div class="box box-bordered border-danger m-0 no-padding">
    <div class="box-header with-border py-3">
        <h5 class="box-title">
            {{ __('site.user_index.quta_usage.title') }}
            <span class="badge text-primary px-2 fs-16">
                {{ $userFullname ?? '' }}
            </span>
        </h5>
    </div>
    <div class="box-body p-1">
        <ul class="nav nav-pills justify-content-center px-3">
            <li>
                <a href="#" class="nav-link py-1 @if ($tabActive == 1) active @endif" data-bs-toggle="tab"
                    aria-expanded="false" wire:click="$set('tabActive',1)">

                    {{ __('site.user_index.quta_usage.tab_current_month') }}
                </a>
            </li>
            <li>
                <a href="#" class="nav-link py-1 @if ($tabActive == 2) active @endif" data-bs-toggle="tab"
                    aria-expanded="false" wire:click="$set('tabActive',2)">

                    {{ __('site.user_index.quta_usage.tab_older_monthes') }}
                </a>
            </li>
        </ul>
        <div class="collectionTable">
            @include('backend.admins.users.includes.show_quta.desktop')
            @include('backend.admins.users.includes.show_quta.mobile')
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer p-2">
        <div class="pull-right">
            <a href="#" data-bs-dismiss="modal" class="btn btn-danger">
                @lang('website.cancel')
            </a>
        </div>
    </div>
</div>
<!-- /.box -->
