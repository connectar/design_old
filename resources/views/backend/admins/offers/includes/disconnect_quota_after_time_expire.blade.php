@php($defaultMb = (int) config('offers.broadband_expire_quta', 250))
<div class="row mt-2">
    <div class="col-md-8">
        <div class="form-group row align-items-center">
            <label class="form-label col-12 col-md-4">{{ __('adding.offer.disconnect_quota_after_time_label') }}</label>
            <div class="col-12 col-md-8 d-flex flex-wrap align-items-center gap-2">
                <input type="hidden" name="disconnect_quota_mb_after_time_expire"
                    x-model="offer.disconnect_quota_mb_after_time_expire">
                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#disconnectQuotaAfterTimeExpireModal"
                    @click="tempDq = parseInt(offer.disconnect_quota_mb_after_time_expire, 10) || {{ $defaultMb }}">
                    {{ __('adding.offer.disconnect_quota_after_time_modal_open') }}
                </button>
                <span class="badge bg-secondary"
                    x-text="(parseInt(offer.disconnect_quota_mb_after_time_expire, 10) || {{ $defaultMb }}) + ' {{ __('adding.offer.mb_short') }}'"></span>
            </div>
        </div>
        <p class="text-muted small mb-0">{{ __('adding.offer.disconnect_quota_after_time_help') }}</p>
    </div>
</div>

<div class="modal fade" id="disconnectQuotaAfterTimeExpireModal" tabindex="-1"
    aria-labelledby="disconnectQuotaAfterTimeExpireModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="disconnectQuotaAfterTimeExpireModalLabel">
                    {{ __('adding.offer.disconnect_quota_after_time_modal_title') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label class="form-label">{{ __('adding.offer.disconnect_quota_after_time_modal_field') }}</label>
                <input type="number" class="form-control" min="0" max="999999" step="1" x-model.number="tempDq">
                <p class="small text-muted mt-2 mb-0">{{ __('adding.offer.disconnect_quota_after_time_modal_hint') }}
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('website.cancel') }}</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                    @click="offer.disconnect_quota_mb_after_time_expire = Math.min(999999, Math.max(0, parseInt(tempDq, 10) || {{ $defaultMb }}))">
                    {{ __('website.save') }}</button>
            </div>
        </div>
    </div>
</div>
