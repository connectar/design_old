<section class="h-100vh position-relative z-1" data-overlay="5">
    <div class="container h-p100">
        <div class="row h-p100 align-items-center">
            <div class="col-lg-6 col-12">
                <div class="mt-80">
                    <h1 class="box-title text-white mb-20 fw-600 fs-60">
                        @lang('frontend.slider_title')</h1>
                    <h4 class="text-white-80 fw-300 mb-30 text-center">
                        @lang('frontend.slider_title_content')
                    </h4>
                    <div class="d-flex gap-3 justify-content-start">
                        <a href="#plans" class="btn btn-info">
                            @lang('frontend.plans_register')
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline btn-info text-white">
                            @lang('frontend.plans_login')
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="text-center">
                    <div class="owl-carousel owl-theme owl-btn-1 banner-slide" data-nav-arrow="false"
                        data-nav-dots="false" data-items="1" data-md-items="1" data-sm-items="1" data-xs-items="1"
                        data-xx-items="1">
                        <div class="item">
                            <img src="../images/front-end-img/b-1.png" class="img-fluid" alt="" />
                        </div>
                        <div class="item">
                            <img src="../images/front-end-img/b-2.png" class="img-fluid" alt="" />
                        </div>
                        <div class="item">
                            <img src="../images/front-end-img/b-3.png" class="img-fluid" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
