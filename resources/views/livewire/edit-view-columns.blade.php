<div class="box border-primary m-0 py-1">
    <div class="box-header py-1">
        <h5 class="box-title text-primary">
            ترتيب واظهار الاعمدة
        </h5>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        @if ($step == 1)
            <div class="mb-1">
                <span>
                    اختار الاعمدة المراد ظهورها ثم اضغط <span class="text-info">التالى</span>
                </span>
            </div>
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th class="py-1">اظهار</th>
                        <th class="py-1">اسم العمود</th>
                    </tr>
                </thead>
                @foreach ($columns as $key => $text)
                    <tr>
                        <td width="20px" class="py-1 text-center">
                            <span class="h-20 flex-shrink-0">
                                <input wire:model="selectedColumns" value="{{ $key }}"
                                    type="checkbox" id="{{ $key }}"
                                    class="filled-in chk-col-success">
                                <label for="{{ $key }}" style="height: 20px;"></label>
                            </span>
                        </td>
                        <td class="py-1">
                            <span>
                                {{ $text }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </table>
        @elseif($step == 2)
            <div>
                <span>
                    لتحريك الاعمدة اضغط على
                    <i class="fa fa-bars text-primary"></i>
                    ثم حرك اعلى او اسفل
                </span>
            </div>
            <div class="myadmin-dd-empty dd" id="nestable2">
                <ol class="dd-list">
                    @foreach ($selectedColumns as $index => $key)
                        <li class="dd-item dd3-item" data-key="{{ $key }}">
                            <div class="dd-handle dd3-handle bg-dark text-primary"></div>
                            <div class="dd3-content bg-dark">
                                {{ $columns[$key] ?? '---' }}
                            </div>
                        </li>
                    @endforeach
                </ol>
            </div>
        @endif

    </div>
    <!-- /.box-body -->
    <div class="box-footer py-2">
        <div class="pull-right">
            <a href="#" data-bs-dismiss="modal" class="btn btn-sm btn-danger"
                wire:click="buttonCancelClicked">
                {{ __('website.cancel') }}
            </a>
            @if ($step == 1)
                <button type="button" wire:click="$set('step','2')" class="btn btn-sm btn-info">
                    {{ __('website.next') }}
                </button>
            @elseif($step == 2)
                <button type="button" wire:click="$set('step','1')" class="btn btn-sm btn-info">
                    {{ __('website.back') }}
                </button>
                <button wire:click="save" class="btn btn-sm btn-success">
                    {{ __('website.save') }}
                </button>
            @endif
        </div>
    </div>
</div>
