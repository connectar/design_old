<form wire:submit="saveQutaExpiredSettings">
    <div class="box p-0 border-dark">
        <div class="box-header bg-light">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="box-title mb-0">
                    <i class="fa fa-database mx-2"></i>إعدادات صفحة انتهاء الكوته
                </h4>
            </div>
        </div>

        <div class="box-body p-0">
            <div class="card bg-dark mb-3 ">
                <div class="card-header bg-primary text-white">
                    <div>
                        <i class="fa fa-cog mx-2"></i>الإعدادات الأساسية
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                <i class="fa fa-file mx-2"></i>عنوان الصفحة (Page Title)
                            </label>
                            <input type="text" class="form-control" wire:model.live.debounce.400ms="quta_page_title"
                                placeholder="عفوا تم قطع الخدمه">
                            @error('quta_page_title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                <i class="fa fa-heading mx-2"></i>نص العنوان الرئيسي
                            </label>
                            <input type="text" class="form-control" wire:model.live.debounce.400ms="quta_header_text"
                                placeholder="عفوا تم قطع الخدمه">
                            @error('quta_header_text')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label fw-semibold">
                                <i class="fa fa-comment-alt mx-2"></i>الرسالة الرئيسية
                            </label>
                            <textarea class="form-control" rows="3" wire:model.live.debounce.400ms="quta_main_message"
                                placeholder="لقد استهلكت 100 % من باقتك الاساسيه الشهرية"></textarea>
                            @error('quta_main_message')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <div class="col-12 mb-3">
                            <label class="form-label fw-semibold">
                                <i class="fa fa-comment mx-2"></i>رسالة ثانوية (اختياري)
                            </label>
                            <textarea class="form-control" rows="2" wire:model.live.debounce.400ms="quta_secondary_message"
                                placeholder="هذة رسالة تلقائيه من السيرفر"></textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" wire:model.live.debounce.400ms="quta_show_progress_bar"
                                    id="qutaShowProgress">
                                <label class="form-check-label fw-semibold" for="qutaShowProgress">
                                    <i class="fa fa-tasks mx-2"></i>عرض شريط التقدم
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Colors Section -->
            <div class="card bg-dark mb-3 ">
                <div class="card-header bg-warning">
                    <div>
                        <i class="fa fa-text-width mx-2"></i>الألوان والتصميم
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                <i class="fa fa-text-width mx-2"></i>لون خلفية العنوان
                            </label>
                            <div class="color-picker-wrapper">
                                <input type="color" class="form-control form-control-color"
                                    wire:model.live.debounce.400ms="quta_header_bg_color" style="width: 60px;">
                                <input type="text" class="form-control" wire:model.live.debounce.400ms="quta_header_bg_color"
                                    placeholder="#c1272d">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                <i class="fa fa-text-width mx-2"></i>لون خلفية الجسم
                            </label>
                            <div class="color-picker-wrapper">
                                <input type="color" class="form-control form-control-color"
                                    wire:model.live.debounce.400ms="quta_body_bg_color" style="width: 60px;">
                                <input type="text" class="form-control" wire:model.live.debounce.400ms="quta_body_bg_color"
                                    placeholder="#fff">
                            </div>
                        </div>


                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                <i class="fa fa-text-width mx-2"></i>لون خلفية الزر
                            </label>
                            <div class="color-picker-wrapper">
                                <input type="color" class="form-control form-control-color"
                                    wire:model.live.debounce.400ms="quta_button_bg_color" style="width: 60px;">
                                <input type="text" class="form-control" wire:model.live.debounce.400ms="quta_button_bg_color"
                                    placeholder="#C1272D">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Images Section -->
            <div class="card bg-dark mb-3 ">
                <div class="card-header bg-success text-white">
                    <div>
                        <i class="fa fa-image mx-2"></i>الصور والخلفيات
                    </div>
                </div>
                <div class="card-body">
                    <!-- Main Image -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label fw-semibold mb-0">
                                <i class="fa fa-image mx-2"></i>الصورة الرئيسية
                            </label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" wire:model.live.debounce.400ms="quta_show_image"
                                    id="qutaShowImage">
                                <label class="form-check-label" for="qutaShowImage">
                                    عرض الصورة
                                </label>
                            </div>
                        </div>

                        @if ($quta_image_path || $quta_image_upload)
                            <div class="image-preview mb-2">
                                @if ($quta_image_upload)
                                    <img src="{{ $quta_image_upload->temporaryUrl() }}" alt="معاينة">
                                @else
                                    <img src="{{ $quta_image_path }}" alt="الصورة الحالية">
                                @endif
                                <button type="button" class="remove-btn" wire:click="removeQutaImage">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        @endif

                        <div class="upload-zone" onclick="document.getElementById('quta_image_input').click()">
                            <i class="fa fa-upload fa-3x  mb-2"></i>
                            <p class="mb-0">انقر لرفع صورة جديدة</p>
                            <small class="text-muted">أو اسحب الصورة هنا (حجم أقصى 2MB)</small>
                        </div>
                        <input type="file" id="quta_image_input" wire:model.live.debounce.400ms="quta_image_upload" accept="image/*"
                            style="display: none;">
                        @error('quta_image_upload')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <div class="mt-2" dir="ltr">
                            <label class="form-label fw-semibold">
                                أو استخدم مسار الصورة الحالي:
                            </label>
                            <input type="text" class="form-control" wire:model.live.debounce.400ms="quta_image_path"
                                placeholder="/images/2.jpg">
                        </div>

                        <div class="mt-3 p-3 border rounded bg-light">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label fw-semibold mb-0">
                                    <i class="fa fa-expand-arrows-alt mx-2 text-primary"></i>حجم الشعار (Logo Size)
                                </label>
                                <span class="badge bg-primary">{{ $quta_image_size ?? 100 }}%</span>
                            </div>
                            <input type="range" min="10" max="100" step="5"
                                class="form-range" wire:model.live.debounce.200ms="quta_image_size">
                            <div class="d-flex justify-content-between">
                                <small class="text-muted">10%</small>
                                <small class="text-muted">100%</small>
                            </div>
                            @error('quta_image_size')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Background Image -->
                    <div>
                        <label class="form-label fw-semibold">
                            <i class="fa fa-image mx-2"></i>صورة الخلفية
                        </label>

                        @if ($quta_background_image || $quta_background_upload)
                            <div class="image-preview mb-2">
                                @if ($quta_background_upload)
                                    <img src="{{ $quta_background_upload->temporaryUrl() }}" alt="معاينة">
                                @else
                                    <img src="{{ $quta_background_image }}" alt="الخلفية الحالية">
                                @endif
                                <button type="button" class="remove-btn" wire:click="removeQutaBackground">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        @endif

                        <div class="upload-zone" onclick="document.getElementById('quta_bg_input').click()">
                            <i class="fa fa-upload fa-3x  mb-2"></i>
                            <p class="mb-0">انقر لرفع صورة خلفية</p>
                            <small class="text-muted">أو اسحب الصورة هنا (حجم أقصى 5MB)</small>
                        </div>
                        <input type="file" id="quta_bg_input" wire:model.live.debounce.400ms="quta_background_upload"
                            accept="image/*" style="display: none;">
                        @error('quta_background_upload')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <div class="mt-2" dir="ltr">
                            <label class="form-label fw-semibold">
                                أو استخدم مسار الخلفية الحالي:
                            </label>
                            <input type="text" class="form-control" wire:model.live.debounce.400ms="quta_background_image"
                                placeholder="/images/1.jpg">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Button Settings Section -->
            <div class="card bg-dark mb-3 ">
                <div class="card-header bg-info text-white">
                    <div>
                        <i class="fa fa-mouse-pointer mx-2"></i>إعدادات الزر
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                <i class="fa fa-text-width mx-2"></i>نص الزر
                            </label>
                            <input type="text" class="form-control" wire:model.live.debounce.400ms="quta_button_text"
                                placeholder="لوحة التحكم">
                            @error('quta_button_text')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3" dir="ltr">
                            <label class="form-label fw-semibold">
                                <i class="fa fa-link mx-2"></i>رابط الزر
                            </label>
                            <input type="text" class="form-control text-left" wire:model.live.debounce.400ms="quta_button_url"
                                placeholder="/users/login">
                            @error('quta_button_url')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Custom Buttons Section -->
            <div class="card bg-dark mb-3 ">
                <div class="card-header text-white">
                    <div>
                        <i class="fa fa-plus-circle mx-2"></i>أزرار مخصصة إضافية
                    </div>
                </div>
                <div class="card-body">
                    @foreach ($quta_custom_buttons as $index => $button)
                        <div class="position-relative bg-light mb-4 p-4">

                            <button type="button" class="delete-btn"
                                x-on:click="confirmDeleteQutaCustomButtonBtn({{ $index }})">
                                <i class="fa fa-trash"></i>
                            </button>
                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-tag mx-2"></i>نص الزر
                                    </label>
                                    <input type="text" class="form-control"
                                        wire:model.live.debounce.400ms="quta_custom_buttons.{{ $index }}.text"
                                        placeholder="تواصل معنا">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-link mx-2"></i>رابط الزر
                                    </label>
                                    <input type="text" class="form-control"
                                        wire:model.live.debounce.400ms="quta_custom_buttons.{{ $index }}.url"
                                        placeholder="https://wa.me/1234567890">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-bell mx-2"></i>ايقونة الزر
                                    </label>
                                    <div class="input-group p-0">
                                        <div class="input-group-addon">
                                            <i class="fa fa-icons text-primary"></i>
                                        </div>

                                        <select class="form-select"
                                            wire:model.live.debounce.400ms="quta_custom_buttons.{{ $index }}.icon">
                                            <!-- Social -->
                                            <optgroup label="وسائل التواصل">
                                                <option value="fa fa-whatsapp">WhatsApp</option>
                                                <option value="fa fa-facebook">Facebook</option>
                                                <option value="fa fa-twitter">Twitter</option>
                                                <option value="fa fa-instagram">Instagram</option>
                                                <option value="fa fa-telegram">Telegram</option>
                                                <option value="fa fa-youtube">YouTube</option>
                                                <option value="fa fa-linkedin">LinkedIn</option>
                                                <option value="fa fa-snapchat">Snapchat</option>
                                            </optgroup>

                                            <!-- Communication -->
                                            <optgroup label="الاتصال">
                                                <option value="fa fa-phone">Phone</option>
                                                <option value="fa fa-envelope">Email</option>
                                                <option value="fa fa-comment">Comment</option>
                                                <option value="fa fa-comments">Comments</option>
                                                <option value="fa fa-video-camera">Video</option>
                                                <option value="fa fa-microphone">Microphone</option>
                                            </optgroup>

                                            <!-- Generic UI -->
                                            <optgroup label="أيقونات عامة">
                                                <option value="fa fa-home">Home</option>
                                                <option value="fa fa-user">User</option>
                                                <option value="fa fa-users">Users</option>
                                                <option value="fa fa-lock">Lock</option>
                                                <option value="fa fa-unlock">Unlock</option>
                                                <option value="fa fa-cog">Settings</option>
                                                <option value="fa fa-wrench">Tools</option>
                                                <option value="fa fa-trash">Delete</option>
                                                <option value="fa fa-edit">Edit</option>
                                                <option value="fa fa-save">Save</option>
                                                <option value="fa fa-refresh">Refresh</option>
                                                <option value="fa fa-search">Search</option>
                                                <option value="fa fa-check">Check</option>
                                                <option value="fa fa-times">Close</option>
                                                <option value="fa fa-plus">Add</option>
                                                <option value="fa fa-minus">Remove</option>
                                                <option value="fa fa-download">Download</option>
                                                <option value="fa fa-upload">Upload</option>
                                                <option value="fa fa-globe">Globe</option>
                                                <option value="fa fa-star">Star</option>
                                                <option value="fa fa-heart">Heart</option>
                                                <option value="fa fa-info-circle">Info</option>
                                                <option value="fa fa-exclamation-triangle">Warning</option>
                                                <option value="fa fa-calendar">Calendar</option>
                                                <option value="fa fa-clock-o">Clock</option>
                                            </optgroup>
                                        </select>
                                    </div>

                                    @error("quta_custom_buttons.{$index}.icon")
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-text-width mx-2"></i>لون الزر
                                    </label>
                                    <div class="color-picker-wrapper">
                                        <input type="color" class="form-control form-control-color"
                                            wire:model.live.debounce.400ms="quta_custom_buttons.{{ $index }}.color"
                                            style="width: 60px;">
                                        <input type="text" class="form-control"
                                            wire:model.live.debounce.400ms="quta_custom_buttons.{{ $index }}.color"
                                            placeholder="#25D366">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox"
                                            wire:model.live.debounce.400ms="quta_custom_buttons.{{ $index }}.enabled"
                                            id="qutaBtn{{ $index }}Enabled">
                                        <label class="form-check-label" for="qutaBtn{{ $index }}Enabled">
                                            تفعيل هذا الزر
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Add New Button -->
                    <div class="custom-button-card add-button-card text-center py-4" wire:click="addQutaCustomButton">
                        <i class="fa fa-plus-circle fa-3x text-success mb-2"></i>
                        <h5 class="text-success mb-0">إضافة زر مخصص جديد</h5>
                        <small class="text-muted">مثل: واتساب، فيسبوك، تليجرام، إلخ</small>
                    </div>

                </div>
            </div>

        </div>

    </div>

</form>
