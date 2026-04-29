<div class="row">

    <style>
        .install-tabs {
            border-bottom: 2px solid #1f2d3f;
            margin-bottom: 16px;
            padding: 0 8px;
        }
        .install-tabs .nav-link {
            color: #c9d4e4;
            font-weight: 600;
            border: none;
            padding: 12px 22px;
            margin-inline-end: 6px;
            border-radius: 10px 10px 0 0;
            background: transparent;
            transition: all .25s ease;
        }
        .install-tabs .nav-link:hover {
            background: #1a2333;
            color: #fff;
        }
        .install-tabs .nav-link.active {
            background: #0f1a2d;
            color: #ffcf70;
            border-bottom: 3px solid #ffcf70;
        }
        .install-tabs .nav-link i {
            margin-inline-end: 6px;
        }
        .variables-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 12px;
            padding: 12px;
            direction: rtl;
        }
        .variable-card {
            background: linear-gradient(135deg, #111a2c 0%, #0c1422 100%);
            border: 1px solid #1f2d3f;
            border-radius: 12px;
            padding: 14px 16px;
            color: #dbe4f0;
            box-shadow: 0 2px 6px rgba(0,0,0,.2);
            transition: transform .2s, border-color .2s;
        }
        .variable-card:hover {
            transform: translateY(-2px);
            border-color: #ffcf70;
        }
        .variable-card .var-name {
            display: inline-block;
            background: #2563eb;
            color: #fff;
            padding: 4px 10px;
            border-radius: 6px;
            font-family: 'Courier New', monospace;
            font-weight: 700;
            font-size: 13px;
            direction: ltr;
        }
        .variable-card .var-desc {
            color: #a7b3c7;
            font-size: 13px;
            line-height: 1.7;
            margin: 8px 0;
        }
        .variable-card .var-value {
            display: inline-block;
            background: #a82027;
            color: #fff;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            word-break: break-all;
            max-width: 100%;
        }
    </style>

    <ul class="nav install-tabs" role="tablist" x-data>
        <li class="nav-item" role="presentation">
            <a class="nav-link active" data-bs-toggle="tab" href="#tab-install-editor" role="tab">
                <i class="fa fa-code"></i>الأكواد
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#tab-install-variables" role="tab">
                <i class="fa fa-list-alt"></i>المتغيرات
            </a>
        </li>
    </ul>

    <div class="tab-content">
    <div class="tab-pane fade show active" id="tab-install-editor" role="tabpanel">

    <div class="row">
        <div class="form-group col-md-6">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-server"></i>
                    <span class="px-2">اختيار النسخة</span>
                </div>
                <select class="form-select" id="sectionSelector" wire:model.live="nasVersion">
                    @foreach (\App\ENUMS\CommandTemplateEnum::getMicrotikVersions() as $version)
                            <option value="{{ $version }}">
                                {{ \App\ENUMS\CommandTemplateEnum::getMicrotikVersionLabel($version) }}
                            </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group col-md-6">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-server"></i>
                    <span class="px-2">اختيار الخطوة</span>
                </div>
                <select class="form-select" id="sectionSelector" wire:model.live="section">
                    <option value="{{ \App\ENUMS\CommandTemplateEnum::MICROTIK_SECTION_ALL }}">
                        {{ \App\ENUMS\CommandTemplateEnum::matchMicrotikSection(\App\ENUMS\CommandTemplateEnum::MICROTIK_SECTION_ALL) }}
                    </option>
                    @foreach ($install_sections as $install_section)
                        <option value="{{ $install_section }}">
                            {{ \App\ENUMS\CommandTemplateEnum::matchMicrotikSection($install_section) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-12">
            <div class="box">
                <div class="box-body p-4">
                    <div class="d-flex">
                        <button class="btn btn-success btn-xl mx-2" style="{{ $section == \App\ENUMS\CommandTemplateEnum::MICROTIK_SECTION_ALL ? 'display:none;' : '' }}" data-bs-toggle="modal" wire:loading.attr="disabled" data-bs-target="#bs-update-modal-lg">
                            <i class="glyphicon glyphicon-pencil px-1"></i>
                            تعديل اكواد التركيب
                        </button>
                        <button class="btn btn-danger btn-xl mx-2 " data-bs-toggle="modal" wire:loading.attr="disabled" wire:click="test" data-bs-target="#bs-test-modal-lg">
                            <i class="fa fa-binoculars px-1"></i>
                            اختبار اكواد التركيب
                        </button>
                        <button class="btn btn-danger btn-xl mx-2 " data-bs-toggle="modal" wire:loading.attr="disabled" wire:click="testBeforeAfter" data-bs-target="#bs-test-before-after-modal-lg">
                            <i class="fa fa-binoculars px-1"></i>
                            اختبار اكواد التركيب (قبل/بعد)
                        </button>
                        <button type="button" class="btn btn-info fw-bold btn-rounded" wire:click="copyScript">
                            نسخ كود التركيب
                        </button>
                    </div>
                </div>
            </div>
            <div class="box col-md-12" style="font-family: 'Courier New', monospace;background-color:#0f0f0f;">
                <div class="d-flex justify-content-between ">
                    <div class="">
                        <h4 class="box-title p-4 " >اكواد التركيب - (
                            <span class="text-primary">
                                {{ \App\ENUMS\CommandTemplateEnum::getMicrotikVersionLabel($nasVersion) }}
                            </span>
                            )
                        </h4>
                    </div>
                    <div class="pt-4">
                        <div class="form-group row col-12" >
                            <label for="quta" class="form-label col-md-8">
                                {{ __('site.devices_index.test_nas_serial') }}
                            </label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input class="form-control" type="number" step="any" min="1"
                                        wire:model="test_nas_serial">
                                </div>
                                <span class="text-danger">
                                    @error('test_nas_serial')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <div wire:ignore class="box">
            <div class="box-header with-border" style="font-family: 'Courier New', monospace;background-color:#0f0f0f;">
                {{-- <h4 class="box-title">اكواد التركيب</h4> --}}
                <ul class="box-controls pull-right">
                    {{-- <li><a class="box-btn-close" href="#"></a></li> --}}
                    <li><a class="box-btn-slide" href="#"></a></li>
                    <li><a class="box-btn-fullscreen" href="#"></a></li>
                </ul>
            </div>
            <div class="box-body" dir="ltr" style="padding: 0%">
                <div style="font-family: 'Courier New', monospace;background-color:#0f0f0f;padding:25px 25px">
                    <div wire:ignore id="editor"
                        style="font-size:16px;height:75vh;font-family: 'Courier New', monospace;background-color:#0f0f0f;">
                    </div>
                </div>
            </div>
        </div>

    </div>

    </div> {{-- end tab-install-editor --}}

    <div class="tab-pane fade" id="tab-install-variables" role="tabpanel">
        @include('backend.managers.command_template.includes.helper', [
            'asCards' => true,
        ])
    </div>

    </div> {{-- end tab-content --}}







    <!-- Update Modal -->
    <div wire:ignore     class="modal fade {{ $errors->any() ? 'show' : '' }}" id="bs-update-modal-lg" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: {{ $errors->any() ? 'block' : 'none' }};">
        <div class="modal-dialog modal-xl ">
            <div class="modal-content ">
                    <div class="modal-header">
                        <h4 class="modal-title text-white" id="myLargeModalLabel">
                            تعديل اكواد التركيب

                            ({{ \App\ENUMS\CommandTemplateEnum::matchMicrotikSection($section) }})
                        </h4>
                        <button type="button" data-bs-dismiss="modal" wire:click="resetErrors" aria-label="Close"
                            class="btn btn-danger py-1 px-2 " style="height:50%;">
                            <i class="fa fa-times fa-x"></i>
                        </button>
                    </div>
                    <div wire:ignore class="modal-body text-center p-2" >

                        <div class=" px-3 mx-4 custom-padding-mobile " dir="ltr" >
                            <div class="pt-4" style="font-family: 'Courier New', monospace;background-color:#0f0f0f;">
                                <div wire:ignore id="beforeeditor" style="font-size:16px;height:25vh;font-family: 'Courier New', monospace;background-color:#0f0f0f;"></div>
                            </div>
                            <h4 class="bg-danger p-2">
                                قبل التعديل
                            </h4>
                            <div  class="my-4 border-light"></div>
                            <div>
                                <h4 class="bg-success p-2 m-0" >
                                    بعد التعديل
                                </h4>
                                <div class="pt-4" style="font-family: 'Courier New', monospace;background-color:#0f0f0f;">
                                    <div wire:ignore id="aftereditor"  style="font-size:16px;height:25vh;font-family: 'Courier New', monospace;background-color:#0f0f0f;"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <button type="submit" wire:loading.attr="disabled" class="btn btn-success" data-dismiss="modal"
                            wire:click.prevent="update">
                            حفظ التعديلات
                        </button>
                        <button type="button" class="btn btn-danger text-start" id="closeModalBtn" data-bs-dismiss="modal"
                            wire:click="resetErrors">{{ __('new_trans.close') }}</button>
                    </div>
            </div>
        </div>
    </div>
    <!-- update  Modal -->


        <!-- Test  Modal -->
        <div wire:ignore class="modal fade {{ $errors->any() ? 'show' : '' }}" id="bs-test-modal-lg" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabelTwo" aria-hidden="true" style="display: {{ $errors->any() ? 'block' : 'none' }};">
            <div class="modal-dialog modal-xl ">
                <div class="modal-content ">
                        <div class="modal-header">
                            <h4 class="modal-title text-white" id="myLargeModalLabelTwo">
                                اختبار اكواد التركيب
                            </h4>
                            <button type="button" data-bs-dismiss="modal" wire:click="resetErrors" aria-label="Close"
                                class="btn btn-danger py-1 px-2 " style="height:50%;">
                                <i class="fa fa-times fa-x"></i>
                            </button>
                        </div>
                        <div  class="modal-body text-center p-2" >
                            <div class=" px-3 mx-4 custom-padding-mobile " dir="ltr" >
                                <div class="pt-4" style="font-family: 'Courier New', monospace;background-color:#0f0f0f;">
                                    <div wire:ignore id="testeditor"  style="font-size:16px;height:75vh;font-family: 'Courier New', monospace;background-color:#0f0f0f;"></div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer d-flex justify-content-end">
                            <button type="button" class="btn btn-danger text-start" id="closeModalBtnTwo" data-bs-dismiss="modal"
                                wire:click="resetErrors">{{ __('new_trans.close') }}</button>
                        </div>
                </div>
            </div>
        </div>
        <!-- Test  Modal -->



        <!-- Test  After/before Modal -->
        <div wire:ignore class="modal fade {{ $errors->any() ? 'show' : '' }}" id="bs-test-before-after-modal-lg" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabelTwo" aria-hidden="true" style="display: {{ $errors->any() ? 'block' : 'none' }};">
            <div class="modal-dialog modal-xl ">
                <div class="modal-content ">
                        <div class="modal-header">
                            <h4 class="modal-title text-white" id="myLargeModalLabelTwo">
                                اختبار اكواد التركيب
                            </h4>
                            <button type="button" data-bs-dismiss="modal" wire:click="resetErrors" aria-label="Close"
                                class="btn btn-danger py-1 px-2 " style="height:50%;">
                                <i class="fa fa-times fa-x"></i>
                            </button>
                        </div>
                        <div  class="modal-body text-center p-2" >

                            <div class=" px-3 mx-4 custom-padding-mobile " dir="ltr" >
                                <div class="pt-4" style="font-family: 'Courier New', monospace;background-color:#0f0f0f;">
                                    <div wire:ignore id="testbeforeeditor" style="font-size:16px;height:30vh;font-family: 'Courier New', monospace;background-color:#0f0f0f;"></div>
                                </div>
                                <h4 class="bg-danger p-2">
                                    قبل التعديل
                                </h4>
                                <div  class="my-4 border-light"></div>
                                <div>
                                    <h4 class="bg-success p-2 m-0" >
                                        بعد التعديل
                                    </h4>
                                    <div class="pt-4" style="font-family: 'Courier New', monospace;background-color:#0f0f0f;">
                                        <div wire:ignore id="testaftereditor"  style="font-size:16px;height:30vh;font-family: 'Courier New', monospace;background-color:#0f0f0f;"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer d-flex justify-content-end">
                            <button type="button" class="btn btn-danger text-start" id="closeModalBtnTwo" data-bs-dismiss="modal"
                                wire:click="resetErrors">{{ __('new_trans.close') }}</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
        <!-- Test After/before Modal -->



@push('scripts')
    <script>
        document.addEventListener("livewire:init", function() {
            console.log("Livewire loaded");

            var editor = ace.edit("editor");
            var beforeEditor = ace.edit("beforeeditor");
            var afterEditor = ace.edit("aftereditor");
            var testEditor = ace.edit("testeditor");
            var testBeforeEditor = ace.edit("testbeforeeditor");
            var testAfterEditor = ace.edit("testaftereditor");

            console.log("Ace editors initialized");

            editor.setTheme("ace/theme/monokai");
            editor.getSession().setMode("ace/mode/sh");
            beforeEditor.setTheme("ace/theme/monokai");
            beforeEditor.getSession().setMode("ace/mode/sh");
            afterEditor.setTheme("ace/theme/monokai");
            afterEditor.getSession().setMode("ace/mode/sh");
            testEditor.setTheme("ace/theme/monokai");
            testEditor.getSession().setMode("ace/mode/sh");
            testBeforeEditor.setTheme("ace/theme/monokai");
            testBeforeEditor.getSession().setMode("ace/mode/sh");
            testAfterEditor.setTheme("ace/theme/monokai");
            testAfterEditor.getSession().setMode("ace/mode/sh");


            // Decode HTML entities and set initial content
            var decodedContent = {!! json_encode(htmlspecialchars_decode($this->microtikInstallScriptView)) !!};
            // var decodedOldContent = {!! json_encode(htmlspecialchars_decode($this->microtikInstallScriptOldView)) !!};

            // Decode HTML entities and set initial content
            // var decodedContentCode = {!! json_encode(htmlspecialchars_decode($this->replacePlaceholders($this->microtikInstallScriptView))) !!};
            // var decodedOldContentCode = {!! json_encode(htmlspecialchars_decode($this->replacePlaceholders($this->microtikInstallScriptView))) !!};

            editor.getSession().setValue(decodedContent);
            // beforeEditor.getSession().setValue(decodedOldContent);
            // afterEditor.getSession().setValue(decodedContent);
            // testBeforeEditor.getSession().setValue(decodedOldContentCode);
            // testAfterEditor.getSession().setValue(decodedContentCode);


            editor.setReadOnly(true);
            beforeEditor.setReadOnly(true);
            afterEditor.setReadOnly(true);
            testEditor.setReadOnly(true);
            testBeforeEditor.setReadOnly(true);
            testAfterEditor.setReadOnly(true);

            document.getElementById('editor').style.opacity = '0.8';
            document.getElementById('testeditor').style.opacity = '0.8';
            document.getElementById('beforeeditor').style.opacity = '0.8';
            document.getElementById('aftereditor').style.opacity = '0.8';
            document.getElementById('testbeforeeditor').style.opacity = '0.8';
            document.getElementById('testaftereditor').style.opacity = '0.8';

            console.log("Content set in editor");

            // Set the editor to read-only mode



            // Handle Livewire integration for saving content
            editor.getSession().on('change', function() {
                @this.set('microtikInstallScriptView', editor.getSession().getValue());
                afterEditor.getSession().setValue(editor.getSession().getValue());
            });

            function extractPayload(payload, key) {
                if (payload === null || payload === undefined) return '';
                if (typeof payload === 'string') return payload;
                if (Array.isArray(payload)) return payload[0] ?? '';
                if (typeof payload === 'object') {
                    if (key && key in payload) return payload[key] ?? '';
                    var first = Object.values(payload)[0];
                    return first ?? '';
                }
                return String(payload);
            }

            Livewire.on('sectionUpdated', payload => {
                var newContent = extractPayload(payload, 'content');
                document.getElementById('editor').style.opacity = '1';
                editor.setReadOnly(false);
                editor.getSession().setValue(newContent);

                afterEditor.getSession().setValue(newContent);
                beforeEditor.getSession().setValue(newContent);
            });

            Livewire.on('sectionUpdatedToAll', payload => {
                var newContent = extractPayload(payload, 'content');
                document.getElementById('editor').style.opacity = '0.8';
                editor.setReadOnly(true);
                editor.getSession().setValue(newContent);
            });

            Livewire.on('closeModal', function() {
                document.getElementById('closeModalBtn').click();
            });

            Livewire.on('updateTestCode', payload => {
                var testCode = extractPayload(payload, 'content');
                testEditor.getSession().setValue(testCode);
            });

            Livewire.on('updateTestBeforeAfterCode', payload => {
                var oldCode = '';
                var newCode = '';
                if (payload && typeof payload === 'object' && !Array.isArray(payload)) {
                    oldCode = payload.before ?? '';
                    newCode = payload.after ?? '';
                } else if (Array.isArray(payload)) {
                    oldCode = payload[0] ?? '';
                    newCode = payload[1] ?? '';
                }
                testBeforeEditor.getSession().setValue(oldCode);
                testAfterEditor.getSession().setValue(newCode);
            });
        });


        window.addEventListener("copyScript", (event) => {
            var tempInput = document.createElement("input");
            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = event.detail.script;
            document.body.appendChild(tempInput);
            tempInput.select();
            try {
                var successful = document.execCommand("copy", false, null);
                if (successful) {
                    Swal.fire(event.detail.alert.success);
                }
            } catch (err) {
                Swal.fire(event.detail.alert.error);
                alert("Oops, unable to copy to clipboard");
            }
        });
    </script>
@endpush
