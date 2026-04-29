<div>
    @php
        use App\ENUMS\QuestionTypeEnum;
    @endphp
    <div class="card bg-light mb-3  mx-4 py-3 custom-margin-none" style="word-break:break-all;">
        @if ($this->isAuthorizedManager())
            <div style="display:flex;justify-content:space-between;">
                <div class="custom-margin-top-goback-btn">
                    <a href="{{ route($this->getQuestionsIndexRouteName()) }}" class="btn btn-danger btn-sm ">
                        <i class="fa fa-arrow-left"></i>
                        <span class="custom-display-none">
                            {{ __('new_trans.questions.questions') }}
                        </span>
                    </a>
                </div>

            </div>
        @endif
        <div class="card-header custom-display-grid">
            <div class="">

                <div class="d-flex">
                    <div>
                        <h4 class="text-primary ">
                            <strong>
                                {{ trans('new_trans.questions.question') }} :
                            </strong>
                        </h4>
                    </div>
                </div>
                <div class="d-flex custom-display-block" style="align-items:center;justify-content:center;">

                    <div>
                        <h5 class="text-white px-2 py-2 mx-2">
                            {{ $question->question }}
                        </h5>
                        <div class="mx-2">
                            <div class="input-group mb-2 " style="align-items:center;">
                                <span class="badge badge-info" id="ticketNumber"
                                    style="font-size:13px;padding:9px 10px;">{{ $question->code }}</span>

                                <div class="input-group-append">
                                    <button class="btn btn-secondary copy-button" type="button" id="copyButton">
                                        <i class="fa fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="d-flex custom-display-grid-list ">
                <div class="px-1">
                    <span class="badge badge-info">
                        {{ QuestionTypeEnum::getTypeLabel($question->type) }}
                    </span>
                </div>
                <div class="px-1">
                    @if ($question->is_answered)
                        <span class="badge badge-success">
                            <strong>
                                {{ trans('new_trans.questions.is_answered.true') }}
                            </strong>
                        </span>
                    @else
                        <span class="badge badge-danger">
                            <strong>
                                {{ trans('new_trans.questions.is_answered.false') }}
                            </strong>
                        </span>
                    @endif
                </div>

            </div>
        </div>
        <div class="card-body">
            <div>
                <h4 class="text-primary">
                    <strong>
                        {{ __('new_trans.questions.answers') }}
                    </strong>
                </h4>
            </div>
            @if ($this->isAuthorizedManager())

                <div class="d-flex justify-content-end ">
                    @if ($question->is_answered)
                        <button type="button" class="btn btn-danger mb-3  rounded" wire:loading.attr="disabled"
                            wire:click="flagQuestion(0)">
                            <i class="fa fa-times fa-lg"></i>
                            لم يتم الاجابة
                            <span wire:loading class="px-3">
                                <i class="fa fa-spinner fa-spin fa-lg"></i>
                            </span>
                        </button>
                    @else
                        <button type="button" class="btn btn-success mx-3 rounded " wire:loading.attr="disabled"
                            wire:click="flagQuestion(1)">
                            <i class="fa fa-check fa-lg"></i>
                            تمت الاجابة
                            <span wire:loading class="px-3">
                                <i class="fa fa-spinner fa-spin fa-lg"></i>
                            </span>
                        </button>
                    @endif
                </div>
            @endif
            @if (!empty($question->answer))
                <div class="custom-margin-mobile"
                    style="
           background-color:#0e1e3a;color:rgba(255,255,255,.8);border-radius:10px;margin:10px 40px 30px 40px;">
                    <div style="display:flex;justify-content:space-between;" class="custom-display-grid rounded-lg">
                        <div>
                            <span class=" badge badge-danger  px-4 d-inline-flex py-2 items-center ">
                                <!-- <i class="fa fa-headphones px-2 " style="font-size:25px;"></i> -->
                                <img src="{{ asset('images/ticket-customer-service.png') }}" width="30px" />
                                <h5 class="mt-1 px-1 ">
                                    <strong>
                                        {{ $this->isAuthorizedManager() ? __('new_trans.ticket.replies.tech_support') . ' #' . $question->admin->name : __('new_trans.ticket.replies.tech_support') }}
                                    </strong>
                                </h5>
                            </span>
                        </div>
                        @if ($this->isAuthorizedManager())
                            <div class="d-inline-flex items-center   m-2 fw-lg" x-data="removeAnswerComponent">
                                <span class=" ">
                                    {{ $question->created_at->diffForHumans() }}
                                </span>
                                <div class="mx-4">
                                    <a href="#" x-on:click="removeAnswerAction()" class="del-danger  p-1 text-md">
                                        <i class="fa fa-trash fa-2x"></i>
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="p-2  fw-lg">
                                <span class="">
                                    {{ $question->created_at->diffForHumans() }}
                                </span>
                            </div>
                        @endif

                    </div>
                    <div class="custom-padding-mobile ck-editor-custom bg-dark rounded-lg mt-2 pb-4"
                        style="line-height:2.5!important;">
                        <div class="p-4">
                            {!! html_entity_decode($question->answer) !!}
                        </div>
                        @if (!empty($question->audio_path))
                            <div class="bg-light p-4 rounded-full">
                                <audio controls class="w-full mt-2">
                                    <source src="{{ $question->audio_path }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                        @endif
                    </div>

                </div>
            @else
                <div class="card-body">
                    <h5 class="card-title text-white">{{ __('new_trans.questions.no_replies_yet.title') }}</h5>
                    <p class="card-text">
                        {{ __('new_trans.questions.no_replies_yet.message') }}
                    </p>
                </div>
            @endif
        </div>
    </div>


    @if (!$question->is_answered && $this->isAuthorizedManager())
        <div>
            <div style="margin-bottom:100px;background-color:#0e1e3a;padding:20px 15px;border-radius:5px;" wire:ignore
                x-data="answerTextComponent()" class="custom-padding-mobile-for-from">
                <label for="answerText" class="sr-only">Your message</label>
                <textarea x-model="answer" id="answerText" x-ref="answerTextCkeditor"
                    placeholder="{{ __('new_trans.questions.send_your_answer') }}">
                        </textarea>
                <div class="mb-3 d-flex justify-content-center align-items-center">

                    <button wire:loading.attr="disabled" type="button" x-on:click="saveAnswerAction"
                        style="display:block;width:100%;padding:15px;margin:10px auto;"
                        class="text-blue-600 bg-secondary rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                        <svg class="w-5 h-5 rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 18 20">
                            <path
                                d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z" />
                        </svg>
                        <span class="sr-only">Send message</span>
                    </button>
                    {{-- AUDIO --}}
                    <div class="d-grid justify-content-center align-items-center">
                        <label class="btn btn-primary rounded-full mx-3 my-2" wire:loading.attr="disabled">
                            <i class="fa fa-microphone fa-2x"></i>
                            <input type="file" class="d-none" x-on:change="uploadAudio" accept="audio/mp3" />
                        </label>
                        <p x-text="audioName" :class="{ 'd-none': audioName == '' }" class="badge badge-info"></p>
                    </div>
                    {{-- END AUDIO --}}
                </div>
                <div class="px-4 ">
                    @error('answer')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                    @error('uploadedAudio')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                    @error('uploadedImages.*')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    @endif
</div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/custom_questions_styles.css') }}">
@endpush
@push('scripts')
    <script>
        document.getElementById("copyButton").addEventListener("click", function() {
            // Get the text from the badge
            var ticketNumber = document.getElementById("ticketNumber").textContent;

            // Create a temporary input element and append it to the body
            var tempInput = document.createElement("input");
            tempInput.value = ticketNumber;
            document.body.appendChild(tempInput);

            // Select the text in the input element
            tempInput.select();
            tempInput.setSelectionRange(0, 99999); // For mobile devices

            // Copy the selected text to the clipboard
            document.execCommand("copy");

            // Remove the temporary input element
            document.body.removeChild(tempInput);

            // Change the icon to indicate successful copy
            var copyButton = document.getElementById("copyButton");
            copyButton.innerHTML = '<i class="fa fa-check"></i>';
            setTimeout(function() {
                copyButton.innerHTML = '<i class="fa fa-copy"></i>';
            }, 3000); // Change back to the copy icon after 1 second

        });

        function expandTextarea(textarea) {
            textarea.style.height = "auto";
            textarea.style.height = (textarea.scrollHeight) + "px";
        }

        function handleEnter(event) {
            if (event.key === "Enter" && !event.shiftKey) {
                event.preventDefault();
                const textarea = event.target;
                textarea.value += "\n";
                expandTextarea(textarea);
            }
        }

        function answerTextComponent() {
            return {
                answer: '',
                editor: null,
                showCreateAnswerModal: false,
                audioName: '',
                init() {
                    this.initializeEditor();
                },
                initializeEditor() {

                    this.editor = ClassicEditor.create(this.$refs.answerTextCkeditor, {
                        language: {
                            toolbar: 'ar',
                            ui: 'ar',
                            content: 'ar'
                        },
                        resize_enabled: true,
                        extraPlugins: [CustomUploadAdapterPlugin],
                    });

                    this.editor.then(editor => {
                            editor.model.document.on('change:data', () => {
                                this.answer = editor.getData();
                            });
                            if (editor.getData() != this.answer) {
                                editor.setData(this.answer);
                            }
                        })
                        .catch(error => {
                            console.error('Error initializing CKEditor:', error);
                        });


                },
                saveAnswerAction() {
                    @this.call('saveAnswerAction', this.answer);
                },
                uploadAudio(event) {
                    const file = event.target.files[0];
                    if (file) {
                        @this.upload('uploadedAudio', file);
                        this.audioName = file.name.slice(0, 10) + '..';
                    }
                }
            }
        }

        function removeAnswerComponent() {
            return {
                removeAnswerAction() {
                    confirmDelete('حذف الاجابة', 'هل أنت متأكد من حذف الاجابة؟').then((result) => {
                        if (result.isConfirmed) {
                            @this.call('removeAnswerAction');
                        }
                    });
                }
            };
        }
        class LaravelUploadAdapter {
            constructor(loader) {
                this.loader = loader;
            }

            upload() {
                return this.loader.file.then(file => new Promise((resolve, reject) => {
                    @this.upload('uploadedImages', file);
                }));
            }
        }

        function CustomUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return new LaravelUploadAdapter(loader);
            };
        }
        document.addEventListener("livewire:init", function() {
            Livewire.hook('morph.updated', ({ el, component }) => {
                updateOembed();
            });
        });

        window.addEventListener('livewire:init', (message, component) => {
            updateOembed();
        });

        function updateOembed() {
            document.querySelectorAll('oembed[url]').forEach(element => {
                const url = element.getAttribute('url');
                if (!url) return;

                // Prevent duplicate anchors
                if (!element.querySelector('a.embedly-card')) {
                    const anchor = document.createElement('a');
                    anchor.setAttribute('href', url);
                    anchor.className = 'embedly-card';

                    element.appendChild(anchor);
                }
            });
        }
    </script>
@endpush
