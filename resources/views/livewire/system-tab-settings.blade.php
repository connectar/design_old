<div class="box border-success m-0" x-data="usersTabSettings">
    <div class="box-body py-0">
        <div class="row">
            @foreach (config('toolkit_list') as $route)
                @php
                    $route['link'] = route($route['route_name']);
                @endphp
                <div class="col-md-6 my-2">
                    <div class="box border-success bg-dark m-0">
                        <div class="box-body text-center">
                            <h5 class="card-title text-primary">
                                {{ $route['name'] }}
                            </h5>
                            <div class="mt-3">
                                <a href="{{ $route['link'] }}" class="btn btn-sm btn-success">
                                    اضغط هنا
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- <div class="col-md-6">
                <div class="box border-success bg-dark m-0">
                    <div class="box-body text-center">
                        <h5 class="card-title text-primary">
                            تنصيب سيرفر الميكروتيك
                        </h5>
                        <div class="mt-3">
                            <a href="{{ route('settings.nas_install') }}" class="btn btn-sm btn-success">
                                اضغط هنا
                            </a>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="col-md-6">
                <div class="box border-success bg-dark m-0">
                    <div class="box-body text-center">
                        <h5 class="card-title text-primary">
                            تحميل هوت سبوت الميكروتيك
                        </h5>
                        <div class="mt-3">
                            <a href="{{ route('download_cafe_hotspot') }}" class="btn btn-sm btn-success">
                                اضغط هنا
                            </a>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
