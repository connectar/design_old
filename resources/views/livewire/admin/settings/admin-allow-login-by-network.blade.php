<form wire:submit="saveLoginByNetwork">
    <div class="box border-success m-0">
        <div class="box-body py-0">

            @if ($this->isThereAnyDuplicateUsernamesInNetwork())
                <button type="button" wire:click="$refresh" class=" mx-2 btn btn-sm btn-outline btn-primary"
                    wire:loading.attr="disabled">
                    <i class="fa fa-refresh px-2" wire:loading.remove></i>
                    <i class="fa fa-spinner fa-spin px-2" wire:loading></i>
                    اعادة تحميل
                </button>
                <div class="col-md-12 my-4">
                    <div class="box border-success bg-dark m-0">
                        <div class="col-sm-12  custom-margin-mobile">

                            <div class="d-flex justify-content-lg-start p-4">
                                <div class=" mx-2">
                                    <div class="form-group">
                                        <label class="switch switch-secondary " style="opacity: .5">
                                            <input type="checkbox" disabled>
                                            <span class="switch-indicator"></span>
                                        </label>
                                    </div>
                                </div>
                                <h5 for="message" class=" text-primary pt-1" style="opacity: .8">
                                    {{ __('datatable.allow_login_by_network') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 my-4">
                    <div class="box box-danger border-success bg-dark m-0">
                        <div class="col-sm-12  custom-margin-mobile">
                            <div class=" p-4">
                                <h4>
                                    <li class="fa fa-exclamation-triangle px-2"></li>
                                    تنبيه !!
                                </h4>
                                <h5 for="message" class=" text-white pt-1 col-md-9" style="line-height: 1.9;">
                                    بكل أسف، لا يمكن تفعيل الخاصية لأن هناك أكثر من مستخدم على الشبكة يحملون نفس اسم
                                    المستخدم. لتجنب حدوث تعارض بين المستخدمين، يتعين عليك أولاً اختيار أسماء مستخدمين
                                    جديدة وفريدة لكل مستخدم.
                                </h5>
                                <div class="d-flex mx-2">
                                    <div class="form-group">
                                        <label class="switch switch-success">
                                            <input type="checkbox" wire:click="$toggle('showDuplicatedUsers')"
                                                @if ($showDuplicatedUsers) checked @endif>
                                            <span class="switch-indicator"></span>
                                        </label>
                                    </div>
                                    <h5 for="message" class=" text-white pt-2 px-2">
                                        عرض المستخدمين المكررين لنفس اسم المستخدم علي الشبكة
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($showDuplicatedUsers)
                        <div class="col-md-12 my-4">
                            <div class="box box-dark border-success bg-dark m-0">
                                <div class="col-sm-12  custom-margin-mobile">
                                    <div class=" p-4">
                                        <table class="table table-striped table-bordered text-center">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">الاسم الكامل</th>
                                                    <th class="text-center">اسم المستخدم</th>
                                                    <th class="text-center">إجراء</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($duplicatedUsers as $user)
                                                    <tr>
                                                        <td>{{ $user->fullname }}</td>
                                                        <td>{{ $user->username }}</td>
                                                        <td><a href="{{ route('admins.users.edit', $user->id) }}"
                                                                target="_blank" class="btn btn-warning btn-sm">تعديل</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <div class="col-md-12 my-4">
                    <div class="box border-success bg-dark m-0">
                        <div class="col-sm-12 custom-margin-mobile">
                            <div class="d-flex justify-content-lg-start p-4">
                                <div class=" mx-2">
                                    <div class="form-group">
                                        <label class="switch switch-success">
                                            <input type="checkbox" wire:click="$toggle('is_login_by_network_allowed')"
                                                @if ($is_login_by_network_allowed) checked @endif>
                                            <span class="switch-indicator"></span>
                                        </label>
                                    </div>
                                </div>
                                <h5 for="message" class=" text-primary pt-1">
                                    {{ __('datatable.allow_login_by_network') }}
                                </h5>

                            </div>
                            @error('is_login_by_network_allowed')
                                <span class="error text-danger">
                                    * {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
    <div class="d-flex justify-content-end">
        <a href="https://youtu.be/KIL04Mdkg24" target="_blank"  class=" mx-2 p-2 btn btn-sm btn-danger " style="font-size: 16px;">
            <i class="fa fa-youtube  px-2" style="font-size:20px;" ></i>
            شرح الخاصية
        </a>
    </div>
</form>
