<div class="box border-success m-0" x-data="usersTabSettings">
    <div class="box-body py-0">
        <div class="row">
            <div class="col-md-6">
                <div class="box border-success bg-dark m-0">
                    <div class="box-body text-center">
                        <h5 class="card-title text-primary">
                            {{ __('site.users_tab_settigns.title') }}
                        </h5>
                        <div class="mt-3">
                            <button class="btn btn-sm btn-success"
                                @click="doProccess('{{ $message }}')">
                                {{ __('site.users_tab_settigns.button_text') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
