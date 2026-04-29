<div>
    @php
        use App\ENUMS\QuestionTypeEnum;
    @endphp
    <x-modals.modal show="{{ $show }}" maxWidth="4xl" withBorders="border:1px solid rgba(0,0,0,0.1)">
        <x-slot name="title">
            {{-- <h4 class="fs-20 text-primary fw-bold mb-4">
                البحث عن سؤال
            </h4> --}}
        </x-slot>
        <x-slot name="content">
            <div class=" d-block" style="text-align: right;">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group row">
                            <div class="search-box ">
                                <div class="input-group">
                                    <input type="search" wire:model="search" class="form-control"
                                        placeholder="{{ __('new_trans.search') }}" aria-label="Search"
                                        aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" id="button-addon3">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Search Results -->
                    <div class="mt-3">
                        @if ($search)
                            <ul class="list-group" style="font-size:14px;">
                                @forelse($questions as $question)
                                    <a href="{{ route($this->getQuestionsShowRouteName(), $question->id) }}">
                                        <li class="list-group-item d-flex justify-content-between">
                                            {{ $question->question ?? '-' }}
                                            <span
                                                class="badge badge-info mx-2">{{ QuestionTypeEnum::getTypeLabel($question->type) }}
                                            </span>
                                        </li>
                                    </a>
                                @empty
                                    <li class="list-group-item text-muted">{{ __('new_trans.no_result') }}</li>
                                @endforelse
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            {{-- <button type="button" class="btn btn-danger" x-on:click="{{ $show }} = false">
                إلغاء
            </button> --}}
        </x-slot>
    </x-modals.modal>
</div>
