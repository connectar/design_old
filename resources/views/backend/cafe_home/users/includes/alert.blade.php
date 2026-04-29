<div class="px-4 mt-4">
    <div class="alert text-center text-bold">
        <span>
            <i class="fa fa-check fs-40 text-success"></i>
        </span>
        <h4 class="text-bold">
            <span class="">
                {{ __("site.user_index.{$key}.success") }}
            </span>
        </h4>
        <div>
            <div class="row">
                <div class="col-md-4 text-primary">
                    <label for="">عدد النسخ</label>
                    <select id="" class="form-select" wire:model="countOfPaper">
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>

                <div class="col-md-4 text-primary">
                    <label for="">نوع الطابعه</label>
                    <select id="" class="form-select" wire:model="printerType">
                        <option value="1">طابعه عاديه</option>
                        <option value="2">طابعه حرارى</option>
                    </select>
                </div>
                <div class="col-md-4 mt-20 text-left px-0">
                    <a href="#" class="btn btn-sm btn-success" wire:click="print">
                        <i class="fa fa-print"></i>
                        اطبع الفاتورة
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
