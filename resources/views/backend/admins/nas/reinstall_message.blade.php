@extends('backend.layouts.livewire.admin')

@section('content')
    <div class="box">
        <div class="box-body ribbon-box">
            <div class="ribbon-two ribbon-two-info"><span>رسالة</span></div>
            <div class="text-center">
                <p class="mb-0 text-white">
                    <span class="text-primary fs-20" style="line-height: 1.9;">
                        هام لجميع العملاء
                    </span>
                </p>
                <p class="mb-0 text-white">
                    <span class="text-primary fs-20" style="line-height: 1.9;">
                        تم نقل سيرفر السيستم لزيادة سرعة استجابة السيرفر
                    </span>
                </p>
                <p class="mb-0 text-white">
                    <span class="text-primary fs-20 " style="line-height: 1.9;">
                        برجاء عمل اعادة تركيب للسيرفرات الخاصة بكم
                        <a href="https://chat.whatsapp.com/D20g7KXF9Y557uRzPDa9OW" class="fs-18">
                            <li class="fa fa-whatsapp fa-2x p-2"></li>
                            او المتابعة مع الدعم الفنى على جروب الوتساب
                        </a>
                    </span>
                </p>
                <form method="POST" action="{{ route('admins.reinstall_nas_message') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger mt-3">تمت القراءة</button>
                </form>
            </div>
        </div> <!-- end box-body -->
    </div> <!-- end box -->
@endsection
