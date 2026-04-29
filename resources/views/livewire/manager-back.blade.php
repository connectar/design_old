<div>
    @if (session()->has('manager_login_key'))
        <div class="px-4">
            <a href="#" wire:click="openModal()" class="btn btn-sm btn-danger">
                {{ __('' . $manager_back_trans) }}
            </a>
        </div>
    @endif
    @if (session()->has('cafe_login_key'))
        <div class="px-4">
            <a href="#" wire:click="openModal()" class="btn btn-sm btn-danger">
                {{ __('' . $manager_back_trans) }}
            </a>
        </div>
    @endif
    @if (session()->has('system_distributor_login_key'))
        <div class="px-4">
            <a href="#" wire:click="openModal()" class="btn btn-sm btn-danger">
                {{ __('' . $manager_back_trans) }}
            </a>
        </div>
    @endif
    @if ($showModal)
        <div wire:ignore.self wire:key="modal-send-message" class="modal" id="bs-example-modal-lg-send-message"
            tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
            style="display:block;padding-right:0px!important;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-white">{{ __('new_trans.manager_back') }}</h4>
                        <button type="button" wire:click="closeModal()" aria-label="Close"
                            class="btn btn-danger py-1 px-2" style="height:50%;">
                            <i class="fa fa-times fa-x"></i>
                        </button>
                    </div>
                    <div class="modal-body p-2">
                        <form wire:submit="backToManagerHome()">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <label for="message" class="col-form-label">
                                                {{ trans('new_trans.manager_password') }}
                                            </label>
                                            <div>
                                                <div class="input-group p-2">
                                                    <input class="form-control" type="password"
                                                        wire:model="managerPassword">
                                                </div>
                                                @error('managerPassword')
                                                    <span class="error text-danger ">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <button type="submit" wire:loading.attr="disabled" wire:click="backToManagerHome"
                            class="btn btn-success text-start">{{ __('new_trans.enter') }}</button>
                        <button type="button" wire:click="closeModal()"
                            class="btn btn-danger text-start">{{ __('new_trans.close') }}</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
