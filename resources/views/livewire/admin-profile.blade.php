<div>
<div class="box box-bordered p-4">
    <div class="box-header with-border py-3">
        <h4 class="box-title">
            {{ __('site.admin_profile.title') }}
        </h4>
    </div>
    <div class="box-body">
        @if ($step == 1)
            <div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="fullname" class="col-form-label">
                                @lang('adding.admin.fullname')
                            </label>
                            <div class="">
                                <input class="form-control" type="text" id="fullname"
                                    wire:model="fullname">
                            </div>
                            @error('fullname')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="name" class="col-form-label">
                                @lang('adding.admin.name')
                            </label>
                            <div class="">
                                <input class="form-control" type="text" id="name"
                                    wire:model="name">
                            </div>
                        </div>
                        @error('name')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="email" class="col-form-label">
                                @lang('adding.admin.email')
                            </label>
                            <div class="">
                                <input class="form-control" type="email" id="email"
                                    wire:model="email">
                            </div>
                        </div>
                        @error('email')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="phone" class="col-form-label">
                                @lang('adding.admin.phone')
                            </label>
                            <div class="">
                                <input class="form-control" type="text" id="phone"
                                    wire:model="phone">
                            </div>
                        </div>
                        <input wire:model="region" type="hidden" id="region">
                        @error('phone')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="other_phone" class="col-form-label">
                                @lang('adding.admin.other_phone')
                            </label>
                            <div class="">
                                <input class="form-control" type="text" id="other_phone"
                                    wire:model="other_phone">
                            </div>
                        </div>
                        @error('other_phone')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- /.col -->
                    {{-- chanage password --}}
                    <div class="form-group row">
                        <label for="change_password" class="col-form-label">
                            @lang('adding.admin.change_password')
                        </label>
                        <div class="">
                            <label class="switch switch-success">
                                <input type="checkbox" wire:model="changePassword" />
                                <span class="switch-indicator"></span>
                            </label>
                        </div>
                    </div>
                </div>
                @if ($changePassword)
                    <div class="row">
                        {{-- <div class="col-md-4">
                            <div class="form-group row">
                                <label for="old_password" class="col-form-label">
                                    @lang('adding.admin.old_password')
                                </label>
                                <div class="">
                                    <input class="form-control" type="password"
                                        placeholder="@lang('adding.admin.old_password_placeholder')"
                                        wire:model="old_password" id="old_password">
                                </div>
                            </div>
                            @error('old_password')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div> --}}

                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="password" class="col-form-label">
                                    @lang('adding.admin.new_password')
                                </label>
                                <div class="">
                                    <input class="form-control" type="password"
                                        wire:model="password" placeholder="@lang('adding.admin.new_password_placeholder')"
                                        id="password">
                                </div>
                            </div>
                            @error('password')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="password2" class="col-form-label">
                                    @lang('adding.register.admin_password2')
                                </label>
                                <div class="">
                                    <input class="form-control" type="password"
                                        wire:model="password_confirmation">
                                </div>
                            </div>
                            @error('password_confirmation')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endif
            </div>
        @elseif ($step == 2)
            <div class="px-4 mt-4">
                <div class="alert text-center text-bold">
                    <span>
                        <i class="fa fa-check fs-40 text-success"></i>
                    </span>
                    <h4 class="text-bold">
                        <span class="text-success">
                            {{ __('site.admin_profile.success') }}
                        </span>
                    </h4>
                    <div class="mt-4">
                        <a href="#" wire:click="$set('step',1)"
                            class="btn btn-dark text-primary">
                            {{ __('website.back') }}
                        </a>
                        <a href="{{ route('logout') }}" class="btn btn-warning mx-2">
                            {{ __('site.admin_profile.logout') }}
                        </a>
                    </div>
                </div>
            </div>
        @elseif ($step == 3)
            <div class="px-4 mt-4">
                <div class="alert text-center text-bold">
                    <span>
                        <i class="fa fa-close fs-40 text-danger"></i>
                    </span>
                    <h4 class="text-bold">
                        <span class="text-primary">
                            {{ __('site.admin_profile.error') }}
                        </span>
                    </h4>
                    <div class="mt-4">
                        <a href="#" wire:click="$set('step',1)"
                            class="btn btn-dark text-primary">
                            {{ __('website.back') }}
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <!-- /.box-body -->
    @if ($step == 1)
        <div class="box-footer p-2">
            <div class="pull-right">
                <button type="button" class="btn btn-success" wire:click="save">
                    @lang('website.save')
                </button>
            </div>
        </div>
    @endif
</div>


<!-- /.box -->
<!-- Include IntlTelInput and Initialize it -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script>
    let iti;
    function initializePhoneInput() {
        const phoneInput = document.getElementById("phone");
        let userRegion = "@php echo strtolower($region ?? ''); @endphp";
        let initialCountry = userRegion ? userRegion : getCountryCode();
        if (phoneInput) {  // Ensure the phone input exists
            if (iti) {
                iti.destroy();  // Destroy previous instance if exists
            }
            iti = window.intlTelInput(phoneInput, {
                initialCountry: initialCountry,
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            });
        }
    }

    document.addEventListener('livewire:init', function () {
        initializePhoneInput();
        // Update the region before saving
        Livewire.on('beforeSave', () => {
            const region = iti.getSelectedCountryData().iso2;
            console.log('Selected Region: ', region);
            document.getElementById('region').value = region; // Set hidden input
            @this.set('region', region);
        });
    });

    // Reinitialize intl-tel-input after Livewire updates with a delay
    document.addEventListener('livewire:init', function () {
        Livewire.hook('morph.updated', () => {
            initializePhoneInput();
        });
    });

    /* تم التعديل: حماية من ad-blockers وانقطاع الشبكة (ERR_BLOCKED_BY_CLIENT) */
    function getCountryCode() {
        try {
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.open("GET", "https://www.cloudflare.com/cdn-cgi/trace", false);
            xmlHttp.send(null);
            var country_code = xmlHttp.responseText.replace(/(\r\n|\n|\r)/gm, "").split('loc=')[1]?.split('tls=')[0];
            return country_code ? country_code.toLowerCase() : "eg";
        } catch (e) {
            return "eg";
        }
    }
</script>
</div>

