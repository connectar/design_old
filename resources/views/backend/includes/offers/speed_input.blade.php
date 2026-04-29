<div class="{{ $class ?? 'col-md-6'}}@if(isset($peak_time) && !$peak_time) visibility_hidden @endif">
    <div class="form-group row">
        <label for="speed" class="form-label">@lang('adding.offer.speed')</label>
        <div>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-flash"></i>
                </div>
                <input class="form-control" type="text" placeholder="@lang('adding.offer.speed_placeholder')"
                    name="{{ $name }}" id="{{ $name }}" value="{{ $speed ?? old($name) }}">
                <div class="input-group-addon p-0">
                    <div class="dropdown">
                        <button class="btn btn-md btn-outline b-0 dropdown-toggle" type="button"
                            data-bs-toggle="dropdown">
                            @lang('adding.offer.speed_label')
                        </button>
                        <div class="dropdown-menu scrollable-menu" data-input="{{ $name }}">
                            <span class="dropdown-item changeSpeedText text-white pb-1" data-value="0">
                                <span class="badge badge-pill badge-danger text-bold">
                                    @lang('adding.offer.speed_unlimited')
                                </span>
                                0
                            </span>
                            @foreach (config('offers.Ready_Speed') as $key => $item)
                            @if($key == 'speed_equation')
                            <div class="dropdown-divider"></div>
                            @else
                            <span class="dropdown-item changeSpeedText text-white pb-0" data-value="{{$item}}">
                                <span class="badge badge-pill badge-info text-bold">@lang('adding.offer.' . $key)</span>
                                {{$item}}
                            </span>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
