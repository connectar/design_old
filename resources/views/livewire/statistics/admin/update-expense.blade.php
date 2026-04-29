<div>
  <div >
    <div class="box  p-3" >
      <div class=" d-flex justify-content-between">
        <div class="">
          <h3 class=" p-4 pt-2 ">
            {{__('new_trans.expenses.update_expenses')}}
          </h3>

        </div>

        </div>
        <form wire:submit='update'>

          <div class=" px-4 mx-4" style="text-align:right;">
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
                            wire:model.lazy='amount'>
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
                              <select class="form-select"  wire:model.prevent="nas_id" >
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
                        <textarea class="form-control" style="height:125px;" id='description' placeholder="{{trans('new_trans.expenses.description.placeholder')}}"
                        type="text" wire:model.lazy="description" ></textarea>
                    </div>
                  @error('description')
                    <span class="error text-danger">{{ $message }}</span>
                  @enderror
                </div>
            </div>


          </div>

          <div class="p-3 d-flex" style="justify-content:end;">
            <a href="{{ route($this->redirectExpenseTableRouteName()) }}" class="btn btn-danger mx-2">
              {{__('new_trans.go_back')}}
            </a>
            <button type="submit" wire:submit="update" wire:loading.attr="disabled" class="btn btn-success" >
              {{__('new_trans.update')}}
            </button>
          </div>
      </form>

      </div>
    </div>
  </div>
