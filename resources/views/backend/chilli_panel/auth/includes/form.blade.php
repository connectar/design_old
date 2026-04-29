<form name="form1" METHOD="get" action="{{ route('chili.login') }}">
    <INPUT TYPE="hidden" name="chal" value="{{ $data['challenge'] }}">
    <INPUT TYPE="hidden" name="uamip" value="{{ $data['uamip'] }}">
    <INPUT TYPE="hidden" name="uamport" value="{{ $data['uamport'] }}">
    <INPUT TYPE="hidden" name="userurl" value="{{ $data['userurl'] }}">

    @if (in_array($data['res'], ['failed', 'logoff']) || $errors->any())
        <div class="help-block bg-danger mb-1">
            <ul role="alert">
                <li class="fw-bold p-1">
                    @if ($data['res'] == 'failed')
                        @if ($data['reason'] == 'timeout')
                            {{ __('site.coova_messages_error.timeout') }}
                        @endif
                        @if ($data['reason'] == 'reject')
                            {{ $data['reply'] ?? 'test' }}
                        @endif
                    @endif

                    @if ($data['res'] == 'logoff')
                        {{ __('site.coova_messages_error.logoff') }}
                    @endif

                    @if ($errors->any())
                        <h4>{{ $errors->first() }}</h4>
                    @endif
                </li>
            </ul>
        </div>
    @endif
    <div class="form-group">
        <div class="input-group mb-3">
            <span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
            <input type="text" name="UserName" class="form-control ps-15 bg-transparent"
                placeholder="ادخل رقم الكارت" value="{{ old('name') }}">
        </div>
    </div>
    <div class="row">
        <!-- /.col -->
        <div class="col-12 text-center">
            <button type="submit" name="login" value="login"
                class="btn btn-danger mt-10">@lang('website.login.login')</button>
        </div>
        <!-- /.col -->
    </div>

</form>
