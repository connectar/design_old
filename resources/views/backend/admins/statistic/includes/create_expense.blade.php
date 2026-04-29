<div>
  <div  class="modal fade show" style="display:block;position:fixed!important;" >
    <div class="modal-dialog " style="max-width:40%!important;" >
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title px-3 ">
            {{__('new_trans.expenses.create_expenses')}}
          </h3>
          <div >
            <button wire:loading.attr="disabled" href="#" class="btn btn-danger py-1 px-2 " style="height:50%;" wire:click="hideModal">
               <i class="fa fa-times fa-x"></i>
            </button>
          </div>
        </div>

        <form wire:submit='create'>

          <div class="modal-body px-4 mx-4" style="text-align:right;">
            <div class="form-group row">
                <label for="quta" class="form-label">
                    {{ __('new_trans.expenses.amount') }}
                </label>
                <div>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-money"></i>
                        </div>
                        <input class="form-control" type="number" step="any" min="1"
                            wire:model.lazy="amount">
                    </div>
                    <span class="text-danger">
                        @error('amount')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row">
                <label for="type" class="form-label">
                    {{ trans('new_trans.expenses.nas') }}
                </label>
                <div>
                    <div class="input-group p-0">
                        <div class="input-group-addon">
                            <i class="fa fa-flash text-danger"></i>
                        </div>
                            <select x-data="{ type: null, hasSelected: false }" class="form-select" id="type" wire:model.prevent="nas_id" x-model="type" @change="hasSelected = true">
                                <option value=""  selected x-bind:disabled="hasSelected">
                                    {{ __('new_trans.expenses.select_nas') }}
                                </option>
                                @foreach ($nas as  $network)
                                    <option value="{{ $network->id }}">
                                        {{ $network->name }}
                                    </option>
                                @endforeach
                            </select>
                    </div>
                    @error('nas_id')
                      <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <label for="description" class="col-form-label">
                    {{ trans('new_trans.expenses.description.description') }}
                </label>
                <div>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-bookmark text-primary"></i>
                        </div>
                        <textarea class="form-control" style="height:125px;" id='description' placeholder="{{trans('new_trans.expenses.description.placeholder')}}" type="text"
                          wire:model.lazy="description" >
                        </textarea>
                    </div>
                  @error('description')
                    <span class="error text-danger">{{ $message }}</span>
                  @enderror
                </div>
            </div>

          </div>

          <div class="modal-footer d-flex" style="justify-content:end;">
            <button type="button" wire:loading.attr="disabled" class="btn btn-danger" data-dismiss="modal" wire:click="hideModal">
              {{__('new_trans.close')}}
            </button>
            <button type="submit" wire:loading.attr="disabled" class="btn btn-success" data-dismiss="modal" wire:submit="create">
              {{__('new_trans.add')}}
            </button>
          </div>
      </form>

      </div>
    </div>
  </div>
  <!-- Modal Backdrop -->
  <div class="modal-backdrop fade show" style="z-index: -1;"></div>
  <!-- End Modal -->
<!-- /Users Info Modal -->
</div>
