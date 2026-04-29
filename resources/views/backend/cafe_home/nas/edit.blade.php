@extends('backend.layouts.livewire.cafe')

@section('content')
    <div class="row">
        <div class="col-12">
            <form id="FormSubmit" action="{{ route('cafe_home.nas.update', $nas->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="box bt-3 border-success">
                    <x-box-header back-text="{{ __('adding.nas.all_title') }}"
                        title="{{ __('adding.nas.edit_title') }}"
                        back-route="{{ route('cafe_home.nas.index') }}">
                        <x-slot name="username">
                            <span class="text-black">
                                {{ $nas->name }}
                            </span>
                        </x-slot>
                    </x-box-header>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="offset-md-3 col-md-5">
                                <div class="form-group row">
                                    <label for="name" class="form-label">
                                        {{ __('adding.nas.name') }}
                                    </label>
                                    <div>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-tags text-primary"></i>
                                            </div>
                                            <input class="form-control" type="text"
                                                placeholder="@lang('adding.nas.name_placeholder')" name="nasData[name]"
                                                id="name" value={{ $nas->name }}>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <x-box-footer cancelRoute="{{ route('cafe_home.nas.index') }}"
                            submitText="{{ __('website.save') }}" />
                    </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    @include('backend.includes.scripts.main_js')
@endpush
