<div>
  <form wire:submit="doChangeOfferForUsers">
      <div class="box box-bordered border-danger m-0 p-4 pb-1">
          <div class="box-header with-border py-3">
              <h4 class="box-title">
                  {{ __('site.user_index.changeOffer.title_collection') }}
              </h4>
          </div>
          <div class="box-body no-padding">
              <div class="collectionTable">
              @if ($step == 1)
                @if (count($offers))
                  <div class="d-none d-md-block">
                      <table class="table table-striped text-center no-padding" aria-describedby="dataTableId_info">
                          <x-table-thead :columns="__('datatable.admin_offer_box')" />
                          <tbody>
                              @foreach ($offers as $model)
                              <tr>
                                  <td>{{ $model->name }}</td>
                                  <td class="no-padding">
                                      <span class="badge badge-success badge-pill">
                                          {{ $model->render()->quta() }}
                                      </span>
                                  </td>
                                  <td class="no-padding">
                                      <span class="badge badge-warning badge-pill">
                                          {{ $model->render()->price() }}
                                      </span>
                                  </td>
                                  <td class="no-padding">
                                      <span class="badge badge-danger badge-pill">
                                          {{ $model->render()->duration() }}
                                      </span>
                                  </td>
                                  <td>
                                      <a href="#" class="waves-effect waves-light btn btn-sm btn-info text-bold"
                                          wire:click="goTofinalStep('{{ $model->id }}')">
                                          <i class="fa fa-edit"></i>
                                          {{ __('site.user_index.changeOffer.select_button') }}
                                      </a>

                                  </td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
                  <div class="d-block d-md-none px-2">
                      <div class="row">
                          @foreach ($offers as $model)
                          <div class="col-12">
                              <div class="box box-bordered border-dark">
                                  <div class="box-body py-2">
                                      <div class="text-center mb-1">
                                          <span class="badge badge-white">
                                              {{ $model->name }}
                                          </span>
                                      </div>
                                      <div class="text-center">
                                          <span class="badge badge-dark badge-pill text-success">
                                              الكوتة : {{ $model->render()->quta() }}
                                          </span>
                                          <span class="badge badge-dark badge-pill text-primary">
                                              السعر : {{ $model->render()->price() }}
                                          </span>
                                          <span class="badge badge-dark badge-pill">
                                              المدة : {{ $model->render()->duration() }}
                                          </span>
                                      </div>

                                      <div class="my-1">

                                          <a href="#" class="btn btn-sm btn-info text-bold pull-right"
                                              wire:click="goTofinalStep('{{ $model->id }}')">
                                              <i class="fa fa-edit"></i>
                                              {{ __('site.user_index.changeOffer.select_button') }}
                                          </a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          @endforeach
                      </div>
                  </div>
                    @else
                    <div class="px-4 mt-3">
                        <div class="alert text-center text-bold">
                            <h4 class="text-bold text-primary">
                                <i class="icon fa fa-warning"></i>
                                {{ __('site.user_index.changeOffer.alert_title') }}
                            </h4>
                            <div class="text-center">
                                <x-datatable.empty-records :text="__('site.user_index.changeOffer.empty_offers')" />
                            </div>
                        </div>
                    </div>
                    @endif
                  @else
                  <div class="box border-success m-0">
                      <!-- /.box-header -->
                      <div class="box-body">
                          <span class="text-center">
                              {{ __('site.user_panel.change_offer_action.alert') }}
                          </span>
                          <span class="text-primary px-1">
                              {{ $offerName }}
                          </span>
                      </div>
                  </div>
                  <div class="box border-success m-0">
                      <!-- /.box-header -->
                      <div class="box-body">
                          <div class="row">
                              <div class="col-12">
                                  <div class="form-group row">
                                      <label for="fullname" class="col-sm-2 col-form-label">
                                          {{ __('adding.user_option.change_offer_date') }}
                                      </label>
                                      <div class="col-sm-10">
                                          <select class="form-select" wire:model="dateRangeSelected">
                                              @foreach ($dateRanges as $key => $langKey)
                                                  <option value="{{ $key }}">
                                                      {{ $langKey }}
                                                  </option>
                                              @endforeach
                                          </select>
                                      </div>
                                  </div>
                                  @error('expired_at')
                                      <span class="error text-danger">{{ $message }}</span>
                                  @enderror
                              </div>
                              @if ($showPickAday)
                                  <div class="col-12">
                                      <div class="form-group row">
                                          <label for="fullname" class="col-sm-2 col-form-label">
                                              {{ __('adding.user_option.change_offer_started_at') }}
                                          </label>
                                          <div class="col-sm-10">
                                              <input class="form-control" type="text" id="datepicker"
                                                  wire:model.lazy="other_date">
                                          </div>
                                      </div>
                                      @error('other_date')
                                          <span class="error text-danger">{{ $message }}</span>
                                      @enderror
                                  </div>
                              @endif
                              <div class="col-12">
                                  <div class="form-group row">
                                      <label for="fullname" class="col-sm-2 col-form-label">
                                          {{ __('adding.user_option.change_offer_payment_title') }}
                                      </label>
                                      <div class="col-sm-10">
                                          <div>
                                              <input name="invoiceStatus" wire:model="invoiceStatus"
                                                  type="radio" id="radio_32"
                                                  class="with-gap radio-col-success" value="1">
                                              <label for="radio_32">
                                                  {{ __('adding.user_option.change_offer_payment.1') }}
                                              </label>
                                              <input name="invoiceStatus" wire:model="invoiceStatus"
                                                  type="radio" id="radio_36"
                                                  class="with-gap radio-col-danger" value="0">
                                              <label for="radio_36">
                                                  {{ __('adding.user_option.change_offer_payment.0') }}
                                              </label>
                                          </div>
                                      </div>
                                  </div>
                                  @error('expired_at')
                                      <span class="error text-danger">{{ $message }}</span>
                                  @enderror
                              </div>
                              <div class="col-12">
                                  <div class="form-group row">
                                      <label for="fullname" class="col-sm-2 col-form-label">
                                          المبلغ المطلوب
                                      </label>
                                      <div class="col-sm-10">
                                          <span class="badge text-danger fs-18">
                                              {{ $offerPrice ?? 0 }}
                                          </span>
                                      </div>
                                  </div>
                                  @error('expired_at')
                                      <span class="error text-danger">{{ $message }}</span>
                                  @enderror
                              </div>
                          </div>
                      </div>
                  </div>

                  @endif
              </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
              <div class="pull-right">
                  <a href="#" data-bs-dismiss="modal" wire:click="buttonCancelClicked" class="btn btn-danger">
                      {{ __('website.cancel') }}
                  </a>
                  @if ($step > 1)
                  <button type="button" wire:click="backToOffers" class="btn btn-dark">
                      <i class="fa spi fa-arrow-right"></i>
                      {{ __('site.user_index.changeOffer.back') }}
                  </button>
                  <button type="submit" class="btn btn-success">
                      @lang('website.save')
                  </button>
                  @endif
              </div>
          </div>
      </div>
  </form>
  <!-- /.box -->
</div>
