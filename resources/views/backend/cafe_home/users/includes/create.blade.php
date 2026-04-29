<div class="row">
    {{-- nas serial --}}
    <div class="col-md-4 col-sm-6">
        <div class="form-group row">
            <label for="nas_serial" class="form-label">
                {{ __('adding.user.nas_name') }}
            </label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-server text-success"></i>
                    </div>
                    <select class="selectpicker form-select show-tick p-0"
                        name="userData[nas_serial]">
                        <x-network-nas />
                    </select>
                </div>
            </div>
        </div>
    </div>
    {{-- offer name --}}
    <div class="col-md-4 col-sm-6">
        <div class="form-group row">
            <label for="offer_id" class="form-label">
                {{ __('adding.user.offer_id') }}
            </label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-tags text-primary"></i>
                    </div>
                    <select class="selectpicker form-select show-tick p-0"
                        name="userData[offer_id]">
                        <x-network-offers />
                    </select>
                </div>
            </div>
        </div>
    </div>

</div><!-- end of row-->
<div class="row">
    <div class="col-md-4">
        <div class="form-group row">
            <label for="fullname" class="form-label">
                {{ __('adding.user.fullname') }}
            </label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-id-badge"></i>
                    </div>
                    <input class="form-control" type="text" name="userData[fullname]"
                        id="fullname">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group row">
            <label for="username" class="form-label">
                {{ __('adding.user.username') }}
            </label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                    </div>
                    <input class="form-control" type="text" name="userData[username]"
                        id="username">
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-4 col-sm-6">
        <div class="form-group row">
            <label for="city" class="form-label">
                {{ __('adding.user.city') }}
            </label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <input class="form-control" type="text" name="userData[city]" id="city">
                </div>
            </div>
        </div>
    </div>
</div>
