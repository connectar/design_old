<div class="box border-success">
    <!-- /.box-header -->
    <div class="box-body">
        @if ($debts > 0)
            <div class="text-primary">
                {{ __('site.user_account.add_account_tab.debt_info') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-4 col-12">
                <div class="box box-body pull-up bg-dark text-center">
                    <div class="">
                        <span class="fw-200 fs-20 text-success" dir="auto">
                            {{ $user->account ?? 0 }}
                        </span>
                        <span class="text-muted px-1">جنيه</span>
                    </div>
                    <div class="text-center text-success">
                        {{ __('site.user_account.add_account_tab.account') }}
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="box box-body pull-up bg-dark">
                    <div class="text-center">
                        <span class="fw-200 fs-20 text-danger" dir="auto">
                            {{ $debts ?? 0 }}
                        </span>
                        <span class="text-muted px-1">جنيه</span>
                    </div>
                    <div class="text-center text-danger">
                        {{ __('site.user_account.add_account_tab.debts') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label for="quta" class="form-label">
                        {{ __('site.user_account.add_account_tab.price') }}
                    </label>
                    <div>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-money"></i>
                            </div>
                            <input class="form-control" type="number" min="1"
                                wire:model.lazy="price">
                        </div>
                        <span class="text-danger">
                            @error('price')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label for="note">
                    {{ __('adding.user.notes') }}
                </label>
                <div class="input-group">
                    <span class="input-group-addon vertical-align">
                        <i class="fa fa-bookmark">
                        </i>
                    </span>
                    <textarea class="form-control" rows="3" id="notes" wire:model.lazy="notes"></textarea>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer p-2">
        <div class="pull-right">
            <a href="{{ route('admins.users.index') }}" class="btn btn-danger">
                {{ __('website.cancel') }}
            </a>
            <button type="button" class="btn btn-success" x-on:click="addPrice">
                @lang('website.save')
            </button>

        </div>
    </div>
</div>
