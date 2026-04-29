<div class="fixed-bottom py-0 d-block d-sm-none">
    <div class="box mb-0 rounded-0 bg-info shadow">
        <div class="btn-group">

            <button type="button"
                class="waves-effect waves-light no-caret btn btn-secondary dropdown-toggle"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-reorder"></i>
            </button>
            <div class="dropdown-menu bg-secondary p-10 text-center" style="margin: 0px;">

                <a href="{{ route('login') }}" class="dropdown-item btn btn-danger">
                    تسجيل الدخول
                    <i class="text-white fa fa-sign-in"></i>
                </a>
                <div class="dropdown-divider"></div>
                <a href="https://youtu.be/a0988GkUFKY" target="_blank"
                    class="dropdown-item btn btn-success">
                    شرح الاشتراك
                    <i class="text-white fa fa-youtube"></i>
                </a>

                <div class="dropdown-divider"></div>
                <a href="{{ route('home.system', ['system' => 1]) }}" target="_blank"
                    class="dropdown-item btn btn-info fw-bold">
                    خطط نظام الشبكات
                    <i class="text-white fa fa-info"></i>
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('home.system', ['system' => 2]) }}" target="_blank"
                    class="dropdown-item btn btn-primary fw-bold">
                    خطط نظام الكافيهات
                    <i class="text-white fa fa-info"></i>
                </a>
            </div>
            <a href="{{ route('home.main') }}"
                class="waves-effect waves-light btn bg-gradient-info">
                <i class="fa fa-home fs-30"></i>
            </a>
            <a href="https://youtu.be/a0988GkUFKY" target="_blank"
                class="waves-effect waves-light btn btn-secondary px-0">
                <span style="color: #000;">
                    شرح الاشتراك
                </span>
            </a>
        </div>
    </div>
</div>
