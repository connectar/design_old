<div class="row">
    <div class="col-12">
        <div class="box">
            <x-datatable.loading />
            <div class="box-body p-2">
                <div class="dataTables_wrapper container-fluid dt-bootstrap4">
                    <div class="row" style="margin-top: 5px;margin-bottom: 10px">
                        {{ $navBar ?? '' }}
                    </div>

                    <div class="table-responsive mt-5">
                        <table class="table table-striped table-bordered table-hover text-center">
                            {{ $thead }}
                            <tbody>
                                {{ $tbody }}
                            </tbody>
                        </table>
                    </div>

                    @if ($paginatedData !== null)
                        <x-datatable.table-pagination :paginated-data="$paginatedData" />
                    @endif
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
