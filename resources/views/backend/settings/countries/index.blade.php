@extends('backend.layouts.manger')

@section('content')
    @if ($countries->count())
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="table-responsive">
                            <div id="dataTableId_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row mt-5">
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="dataTableId1" class="table table-striped text-center"
                                            aria-describedby="dataTableId_info">
                                            <x-table-thead :columns="__('datatable.manager_countries_index')" />
                                            <tbody>
                                                @foreach ($countries as $model)
                                                    <tr>
                                                        <td>{{ $model['name'] }}</td>
                                                        <td>{{ $model['code'] }}</td>
                                                        <td>{{ $model['currency'] }}</td>
                                                        <td>{{ $model['currency_code'] }}</td>
                                                        {{-- <td>
                                                        @foreach ($model['timezoned'] as $item)
                                                            {{"[ $item ]"}}
                                                        @endforeach
                                                        </td> --}}
                                                        <!-- Delete country Modal -->
                                                        <div class="modal fade {{ $errors->any() ? 'show' : '' }}"
                                                            id="bs-create-modal-lg-{{ $model['id'] }}" tabindex="-1"
                                                            role="dialog" aria-labelledby="myLargeModalLabel"
                                                            aria-hidden="true"
                                                            style="display: {{ $errors->any() ? 'block' : 'none' }};">
                                                            <div class="modal-dialog modal-md ">
                                                                <div class="modal-content ">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title text-white"
                                                                            id="myLargeModalLabel">
                                                                            {{ __('new_trans.countries.delete_modal.modal_title') }}
                                                                        </h4>
                                                                        <button type="button" data-bs-dismiss="modal"
                                                                            aria-label="Close"
                                                                            class="btn btn-danger py-1 px-2 "
                                                                            style="height:50%;">
                                                                            <i class="fa fa-times fa-x"></i>
                                                                        </button>
                                                                    </div>
                                                                    <form method="POST"
                                                                        action="{{ route('managers.countries.destroy', $model['id']) }}">
                                                                        @csrf
                                                                        @method('DELETE')

                                                                        <div class="modal-body text-center p-2">
                                                                            <div class="modal-body px-4 mx-4 custom-padding-mobile "
                                                                                style="text-align:right;">
                                                                                {{ __('new_trans.countries.delete_modal.modal_text', ['name' => $model['name']]) }}
                                                                            </div>
                                                                            <div
                                                                                class="modal-footer d-flex justify-content-end">
                                                                                <button type="button"
                                                                                    class="btn btn-danger text-start"
                                                                                    data-bs-dismiss="modal"
                                                                                    wire:click="resetErrors">
                                                                                    {{ __('new_trans.close') }}
                                                                                </button>
                                                                                <button type="submit"
                                                                                    class="btn btn-success">
                                                                                    {{ __('new_trans.delete') }}
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Delete country Modal -->
                                                        {{-- Action --}}
                                                        <td>
                                                            @if ($model['code'] !== 'EG')
                                                                <a href="{{ route('managers.countries.edit', $model['id']) }}" class="btn btn-primary btn-sm mx-1 ">
                                                                    <li class="fa fa-cog fa-lg px-1 "></li>
                                                                </a>
                                                                <button class="btn btn-danger btn-sm mx-1 "
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#bs-create-modal-lg-{{ $model['id'] }}">
                                                                    <li class="fa fa-trash fa-lg px-1 "></li>
                                                                </button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    @else
        <div class="box p-4">
            <x-empty-records :title="__('datatable.add_new_country')" />
        </div>
    @endif
@endsection
