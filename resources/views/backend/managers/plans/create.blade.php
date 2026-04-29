@extends('backend.layouts.manger')

@section('content')
    @livewire('manager-plan-create')
    {{-- <div class="row">
        <div class="col-12">
            <form id="FormSubmit" action="{{ route('managers.plans.store') }}" method="POST"
                novalidate>
                @csrf
                @method('POST')
                <div class="box bt-3 border-success">
                    <div class="box-header with-border">
                        <h4 class="box-title">@lang('adding.plan.create_title')</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="name"
                                        class="col-sm-2 col-form-label">@lang('adding.plan.name')</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="name"
                                            placeholder="@lang('adding.plan.name_placeholder')" id="name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="price"
                                        class="col-sm-2 col-form-label">@lang('adding.plan.price')</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"
                                            placeholder="@lang('adding.plan.price_placeholder')" name="price" id="price">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="users"
                                        class="col-sm-2 col-form-label">@lang('adding.plan.users')</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="number" min="1"
                                            placeholder="@lang('adding.plan.users_placeholder')" name="users" id="users">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="servers"
                                        class="col-sm-2 col-form-label">@lang('adding.plan.servers')</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"
                                            value="@lang('adding.plan.servers_placehoder')" id="servers" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="monthes"
                                        class="col-sm-2 col-form-label">@lang('adding.plan.monthes')</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"
                                            value="@lang('adding.plan.monthes_placehoder')" id="monthes" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="offers"
                                        class="col-sm-2 col-form-label">@lang('adding.plan.offers')</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="number" name="offers"
                                            placeholder="@lang('adding.plan.offers_placeholder')" id="offers">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="offers"
                                        class="col-sm-2 col-form-label">@lang('adding.plan.cards')</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="number" name="cards"
                                            placeholder="@lang('adding.plan.cards_placeholder')" id="cards">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="charging"
                                        class="col-sm-2 col-form-label">@lang('adding.plan.charging')</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="number" name="charging"
                                            placeholder="@lang('adding.plan.charging_placeholder')" id="charging">
                                    </div>
                                </div>


                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ route('managers.plans.index') }}"
                            class="btn btn-dark btn-rounded">@lang('website.cancel')</a>
                        <button type="submit"
                            class="btn btn-success btn-rounded">@lang('website.save')</button>
                    </div>
                </div>
            </form>
        </div>
    </div> --}}
@endsection

@push('scripts')
    @include('backend.includes.scripts.main_js')
@endpush
