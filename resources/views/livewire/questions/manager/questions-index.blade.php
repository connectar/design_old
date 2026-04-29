<div>

    <div class="d-flex mobile-display-block justify-content-around">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">{{ __('new_trans.questions.create') }}</h4>
                    <ul class="box-controls pull-right">

                        <li><a class="box-btn-slide" href="#"></a></li>
                        <li><a class="box-btn-fullscreen" href="#"></a></li>
                    </ul>
                </div>
                <div class="box-body">
                    <div class="row">
                        {{-- <div class="col-12" wire:ignore x-data="ckeditorComponent">
                            <textarea id="ckeditor" x-ref="ckeditor" rows="100" cols="80"></textarea>
                            <div class="d-flex justify-content-end">
                                <button type="button" x-on:click="createQuestionAction"
                                    x-on:created:question.window="createdQuestion" wire:loading.attr="disabled"
                                    wire:target="createQuestionAction"
                                    class="btn btn-success mt-3">{{ __('new_trans.questions.post') }}</button>
                            </div>
                        </div> --}}
                        <div class="col-12">
                            <textarea rows="4" class="form-control bg-dark" wire:model="question"></textarea>
                            <div class="d-flex justify-content-end">
                                <button type="button" wire:click="createQuestionAction"
                                    wire:loading.attr="disabled" wire:target="createQuestionAction"
                                    class="btn btn-success mt-3">{{ __('new_trans.questions.post') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <x-datatable :paginated-data="$paginatedData">
        <x-slot name="navBar">
            <div class="container py-3 px-4">
                <div class="row">
                    <div class="col-md-12  col-sm-12 d-flex justify-content-start">
                        <div id="complex_header_filter" class="dataTables_filter">
                            <label>
                                {{ __('datatable.serach') }}
                                <input type="search" class="form-control form-control-md bg-lightest"
                                    style="width: 500px;" wire:model.live.debounce.500ms="search"
                                    placeholder="{{ __('datatable.serach') }}" aria-controls="complex_header"
                                    dir="auto">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="thead">
            @foreach (trans('datatable.manager_questions') as $column => $value)
                <th class="text-center">
                    <span class="badge">
                        {{ $value }}
                    </span>
                </th>
            @endforeach
        </x-slot>

        <x-slot name="tbody">
            @forelse ($paginatedData as $index => $model)
                <tr class="fw-bold">
                    <td class="w-auto">
                        <span class="badge badge-dark">
                            @if (($page ?? 1) != 1)
                                {{ $loop->index + 1 + $perPage * (($page ?? 1) - 1) }}
                            @else
                                {{ $loop->index + 1 }}
                            @endif
                        </span>
                        <span class="dropdown-toggle px-2 badge badge-info" data-bs-toggle="dropdown">
                            {{ $model->code ?? '-' }}
                        </span>
                        <div class="dropdown-menu dropdown-menu-end fw-bold" x-data="dropdownActionComponent">
                            <a class="dropdown-item py-2 fw-bold"
                                href="{{ route('managers.questions.faqs.answers.show', $model->id) }}">
                                <i class="fa fa-eye text-success"></i>
                                {{ __('new_trans.questions.show') }}
                            </a>
                            <a class="dropdown-item py-2 fw-bold" href="#"
                                x-on:click="removeQuestionAction('{{ $model->id }}')">
                                <i class="fa fa-trash-o text-danger"></i>
                                {{ __('site.user_index.option.delete') }}
                            </a>
                        </div>
                    </td>
                    <td class="p-0" width="25px">
                        @if (!$model->is_ignored)
                            <a href="#" wire:click="ignoreQuestionToggle({{ $model->id }})">
                                <i class="fa fa-eye fs-22 text-success"></i>
                            </a>
                        @else
                            <a href="#" wire:click="ignoreQuestionToggle({{ $model->id }})">
                                <i class="fa fa-eye-slash fs-22 text-muted"></i>
                            </a>
                        @endif
                    </td>
                    <td class="no-padding">
                        {{ Str::limit($model->question, 50, '...') ?? '-' }}
                    </td>
                    <td class="no-padding">
                        <div>
                            @if ($model->is_answered)
                                <a type="button" class="btn btn-info btn-sm"
                                    href="{{ route('managers.questions.faqs.answers.show', $model->id) }}">
                                    {{ __('new_trans.questions.show_answers') }}
                                </a>
                            @else
                                <a href="{{ route('managers.questions.faqs.answers.show', $model->id) }}"
                                    class="btn btn-success btn-sm">
                                    {{ __('new_trans.questions.add_answer') }}
                                </a>
                            @endif
                        </div>
                    </td>
                    <td class="no-padding">
                        @if ($model->is_answered)
                            <span class="badge badge-success">
                                تم الرد
                            </span>
                        @else
                            <span class="badge badge-danger">
                                لم يتم الرد
                            </span>
                        @endif
                    </td>
                    <td class="no-padding">
                        {{ $model->created_at ?? '-' }}
                    </td>

                </tr>
            @empty
                <x-datatable.empty-records />
            @endforelse
        </x-slot>
    </x-datatable>
</div>
@push('scripts')
    <script>
        function dropdownActionComponent() {
            return {
                removeQuestionAction(questionId) {
                    confirmDelete('حذف السؤال', 'هل أنت متأكد من حذف السؤال المحدد ؟').then((result) => {
                        if (result.isConfirmed) {
                            @this.call('removeQuestionAction', questionId);
                        }
                    });
                }
            }
        }
    </script>
@endpush
