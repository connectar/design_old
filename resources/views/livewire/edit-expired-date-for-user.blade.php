<div class="box border-success m-0">
    <!-- /.box-header -->
    <div class="box-body">
        <div class="bg-dark d-flex flex-row justify-content-start">
            <div class="alert text-bold">
                <div>
                    <span>
                        {{ __('site.user_edit.edit_expired_at_tab.user.expired_at') }}
                    </span>
                    <span class="text-warning fs-18" dir="auto">
                        {{ $user->render()->expiredAt() }}
                    </span>
                </div>
                <div>
                    <span>
                        {{ __('site.user_edit.edit_expired_at_tab.user.status') }}
                    </span>
                    <span class="text-warning" dir="auto">
                        @if ($userEndDate <= 0)
                            <span class="text-success">
                                لقد انتهى الاشتراك
                            </span>
                        @else
                            <span class="text-primary">
                                متبقى على انتهاء الاشتراك
                            </span>
                            <span class="fs-18 text-danger">
                                {{ humanizeSubscriptionRemaining($user->expired_at ?? null) }}
                            </span>
                        @endif
                    </span>
                </div>
            </div>
        </div>
        <div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="fullname" class="col-form-label">
                            @lang('adding.user_option.expired_at')
                        </label>
                        <div>
                            <input class="form-control" type="text" id="datepicker" readonly
                                wire:model.lazy="expired_at" id="datepicker">
                        </div>
                    </div>
                    @error('expired_at')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <div class="pull-right">

            <a href="{{ route('admins.users.index') }}" class="btn btn-danger">
                {{ __('website.cancel') }}
            </a>
            <button type="button" class="btn btn-success" x-on:click="editExpiredDate()">
                {{ __('website.update') }}
            </button>
        </div>
    </div>
</div>
