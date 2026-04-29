<div class="box border-success m-0 bg-dark">
    <div class="box-header with-border text-center py-1">
        <h4 class="box-title text-white">
            قائمة المشروبات
        </h4>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table class="table table-striped table-borderless text-center b-0">
            <thead>
                <tr class="text-white">
                    <td>اسم الصنف</td>
                    <td>سعر الصنف</td>
                    <td>صورة الصنف</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($drinks as $index => $model)
                    <tr>
                        <td class="no-padding">
                            <span class="badge badge-warning badge-pill">
                                {{ $model['name'] }}
                            </span>
                        </td>
                        <td class="no-padding">
                            <span class="badge badge-warning badge-pill">
                                {{ $model['price'] . ' جنيه' }}
                            </span>
                        </td>
                        <td class="py-1">
                            @if ($model['image'])
                                <img src="{{ asset($model['image']) }}"
                                    class="b-1 border-primary rounded-circle" width="60px"
                                    height="60px">
                            @else
                                <i
                                    class="fa fa-coffee text-primary rounded-circle b-1 border-primary fs-40 p-2"></i>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
