<form wire:submit="submitForm">
    {{-- RTL + number inputs: hide spinners and force LTR so no stray mark appears beside the caret --}}
    <style>
        .quta-number-input::-webkit-outer-spin-button,
        .quta-number-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .quta-number-input[type='number'] {
            -moz-appearance: textfield;
            appearance: textfield;
        }
    </style>
    <div class="box border-success m-0">
        <div class="box-header with-border">
            <h4 class="box-title">
                تعديل السجل السابق
            </h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="collectionTable px-20">
                <div class="row">
                    @foreach ($users as $index => $user)
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="quta" class="form-label">
                                    اسم المشترك : <span
                                        class="text-primary">{{ $user['fullname'] }}</span>
                                </label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-cloud-download"></i>
                                        </div>
                                        <input class="form-control quta-number-input" type="number"
                                            min="0" step="1" inputmode="numeric" dir="ltr"
                                            wire:model="users.{{ $index }}.quta">
                                        <div class="input-group-addon p-0">
                                            <select class="form-select"
                                                wire:model="users.{{ $index }}.quta_unit">
                                                <option value="GIGA">
                                                    {{ __('adding.offer.quta_GIGA') }}
                                                </option>
                                                <option value="MEGA">
                                                    {{ __('adding.offer.quta_MEGA') }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="pull-right">

                <a href="#" data-bs-dismiss="modal" class="btn btn-danger"
                    wire:click="buttonCancelClicked">
                    {{ __('website.cancel') }}
                </a>
                <button type="submit" class="btn btn-success">
                    {{ __('website.update') }}
                </button>
            </div>
        </div>
    </div>
</form>
