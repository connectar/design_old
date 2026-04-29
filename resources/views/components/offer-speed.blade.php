<div class="form-group row">
    <label for="speed" class="form-label fw-bold">
        {{ $speedTitle }}
    </label>
    <div>
        <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-flash text-danger"></i>
            </div>

            <input class="form-control" type="text" name="{{ $name }}" placeholder="
                {{ __('adding.offer.speed_placeholder') }}" x-model="{{$xModel}}" />

            <div class="input-group-addon p-0">
                <div class="dropdown">
                    <button class="btn btn-md btn-outline b-0 dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        {{ __('adding.offer.speed_label') }}
                    </button>
                    <div class="dropdown-menu scrollable-menu" data-input="{{ $name }}">
                        <a href="#" x-on:click="changeSpeed('{{ $name }}','0')">
                            <span class="dropdown-item text-white pb-1">
                                <span class="badge badge-pill badge-danger text-bold">
                                    {{ __('adding.offer.speed_unlimited') }}
                                </span>
                                0
                            </span>
                        </a>
                        @foreach (config('offers.Ready_Speed') as $key => $item)
                            @if ($key == 'speed_equation')
                                <div class="dropdown-divider"></div>
                            @else
                                <a href="#" x-on:click="changeSpeed('{{ $name }}','{{ $item }}')">
                                    <span class="dropdown-item text-white pb-0">
                                        <span class="badge badge-pill badge-info text-bold">
                                            {{ __('adding.offer.' . $key) }}
                                        </span>
                                        {{ $item }}
                                    </span>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
