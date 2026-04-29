@extends('backend.layouts.system_distributor')

@section('content')
@if($plans->count())
<div class="row">
  <div class="col-12">
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body no-padding">
        <div class="table-responsive">
          <div id="dataTableId_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
            <div class="row mt-5">
              <div class="row mt-5">
                {{-- <x-table-header :title="__('datatable.add_new_plan')">
                  <x-table-search />
                </x-table-header> --}}
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <table id="dataTableId1" class="table table-striped text-center" aria-describedby="dataTableId_info">
                    <x-table-thead :columns="__('datatable.manager_plans_trashed_index')" />
                    <tbody>
                      @foreach ($plans as $model)
                      <tr>
                        <td>{{ $model['name'] }}</td>
                        <td>{{ $model['users'] }}</td>
                        <td>{{ $model['price'] }}</td>
                        <td>{{ $model['offers'] }}</td>
                        <td class="text-muted sorting_1">
                          <i class="fa fa-clock-o"></i>
                          {{ $model['deleted_at'] }}
                        </td>
						<td class="p-0" width="25px">
							  @if($model['type'] == \App\ENUMS\PlanTypeEnum::TYPE_NETWORK)
								<span class='badge badge-warning '>
								{{	trans('datatable.system.network') }}
								</span>
							  @elseif($model['type'] == \App\ENUMS\PlanTypeEnum::TYPE_CAFE)
								<span class='badge badge-info '>
								{{ trans('datatable.system.cafe')  }}
								</span>
							  @endif
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
              {{$plans->appends(request()->input())->links()}}
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
