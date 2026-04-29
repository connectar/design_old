@extends('backend.layouts.manger')

@section('content')
@if($managers->count())
<div class="row">
  <div class="col-12">
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body no-padding">
        <div class="table-responsive">
          <div id="dataTableId_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
            <div class="row mt-5">
              <div class="row mt-5">
                <x-table-header :title="__('datatable.add_new_manager')">
                  <x-table-search />
                </x-table-header>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <table id="dataTableId1" class="table table-striped text-center" aria-describedby="dataTableId_info">
                    <x-table-thead :columns="__('datatable.manager_trashed_index')" />
                    <tbody>
                      @foreach ($managers as $model)
                      <tr>
                        <td>{{ $model['fullname'] }}</td>
                        <td>{{ $model['name'] }}</td>
                        <td class="text-muted sorting_1">
                          <i class="fa fa-clock-o"></i>
                          {{ $model['deleted_at'] }}
                        </td>
                        <td>
                          <x-button-restore :model-id="$model['id']" />
                          <x-button-delete :model-id="$model['id']" :title="__('website.delete_trashed')" />
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              {{$managers->appends(request()->input())->links()}}
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
  @push('scripts')
  <script src="{{asset('assets/main_index.js')}}"></script>
  @include('backend.includes.scripts.delete_box')
  @endpush

  @else
  <x-empty-trashed />
  @endif
  @endsection
