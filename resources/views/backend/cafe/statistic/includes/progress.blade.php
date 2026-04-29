<div class="col-12">

    <div class="row px-100">
        @foreach ($progress as $index => $array)

            <div class="col-lg-4 col-md-6">
                <div class="box">
                    <div class="box-body text-center">
                        <h4 class="box-title">
                            {{ __('site.statistics_index.progress.' . $array['key']) }}
                        </h4>
                        <div class="text-center">
                            <div>
                                <input class="knob" data-width="180" data-height="180"
                                    data-linecap="round" data-fgcolor="{{ $array['color'] }}"
                                    value="{{ $array['value'] }}" data-skin="tron"
                                    data-angleoffset="180" data-readonly="true"
                                    data-thickness="{{ $array['thickness'] }}"
                                    readonly="readonly">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
