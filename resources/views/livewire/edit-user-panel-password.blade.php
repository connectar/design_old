<form wire:submit="submitForm">
    <div class="box border-success m-0">
        <div class="box-header with-border">
            <h4 class="box-title">
                {{ __('site.user_index.edit_panel_password.title') }}
                <span class="badge text-primary px-2 fs-16">
                    {{ optional($user)->fullname }}
                </span>
            </h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div>
                <div class="">

                    <span class="badge badge-warning fs-15">
                        <span>
                            {{ __('site.user_index.edit_panel_password.username') }}
                        </span>

                        <span class="mx-2 fs-14">
                            {{ $user->panel->username ?? '' }}
                        </span>
                    </span>
                    <span class="badge badge-info fs-15 ms-30">

                        <span>
                            {{ __('site.user_index.edit_panel_password.password') }}
                        </span>

                        <span class="mx-2 fs-14">
                            {{ $user->panel->password ?? '' }}
                        </span>
                    </span>
                </div>
                @production
                @else
                    <div class="mt-10">
                        <a
                            href="{{ route('users.login', ['username' => $user->panel->username ?? 0, 'password' => $user->panel->password ?? 0]) }}">
                            فتح لوحة العميل
                        </a>
                    </div>
                @endproduction

            </div>

            <div class="mt-30">
                <div class="form-group row">
                    <label class="switch switch-success">
                        <span>
                            {{ __('site.user_index.edit_panel_password.edit_password') }}
                        </span>
                        <input type="checkbox" wire:model="editPassword" />
                        <span class="switch-indicator"></span>
                    </label>
                </div>
            </div>
            @if ($editPassword)
                <div>
                    <div class="p-2">
                        @error('userId')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="fullname" class="col-form-label">
                                    @lang('site.user_index.edit_panel_password.new_password')
                                </label>
                                <div>
                                    <input class="form-control" type="text"
                                        wire:model="password">
                                </div>
                            </div>
                            @error('password')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            @endif

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="pull-right">

                <a href="#" data-bs-dismiss="modal" class="btn btn-danger"
                    wire:click="buttonCancelClicked">
                    {{ __('website.cancel') }}
                </a>
                @if ($editPassword)
                    <button type="submit" class="btn btn-success">
                        {{ __('website.update') }}
                    </button>
                @endif
            </div>
        </div>
    </div>
</form>
