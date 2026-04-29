<div id="plans" class="row mt-100 p-20 justify-content-center pb-50">
    <div class="col-lg-4">
        <div class="box card-shadowed box-inverse bg-gradient-danger">
            <div class="box-body text-center">
                <h3 class="text-uppercase">
                    {{ __('site.home_index.cafe_title') }}
                </h3>
                <hr>
                @foreach (__('site.home_index.cafe_features') as $index => $value)
                    <p class="fw-bold">
                        {{ $value }}
                    </p>
                @endforeach
                <br><br>
                <a class="btn btn-outline btn-white text-white" href="https://cafe.connect4ar.com/system/2">
                    <span class="text-white fs-18 fw-bold">
                        {{ __('site.home_index.select') }}
                    </span>
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="box box-inverse bg-gradient-success">
            <div class="box-body text-center">
                <h3 class="text-uppercase">
                    {{ __('site.home_index.network_title') }}
                </h3>
                <hr>
                @foreach (__('site.home_index.networks_features') as $index => $value)
                    <p class="fw-bold">
                        {{ $value }}
                    </p>
                @endforeach

                <br><br>
                <a class="btn btn-outline btn-white text-white" href="https://connect4ar.com/system/1">
                    <span class="text-white fs-18 fw-bold">
                        {{ __('site.home_index.select') }}
                    </span>
                </a>
            </div>
        </div>
    </div>

</div>
