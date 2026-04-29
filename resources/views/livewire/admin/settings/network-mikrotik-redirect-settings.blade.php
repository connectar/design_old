<div>
    <style>
        .image-preview {
            position: relative;
            display: inline-block;
        }

        .image-preview img {
            max-width: 200px;
            max-height: 150px;
            border-radius: 8px;
            border: 2px solid #ddd;
        }

        .image-preview .remove-btn {
            position: absolute;
            top: -10px;
            right: -10px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
        }

        .image-preview .remove-btn:hover {
            background: #c82333;
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.5);
        }

        .upload-zone {
            border: 2px dashed #4a5568;
            border-radius: 12px;
            padding: 40px 20px;
            margin: 10px 0px;
            text-align: center;
            background: linear-gradient(135deg, #0b1a31 0%, #0f2340 100%);
            cursor: pointer;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .upload-zone::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(166, 165, 182, 0.1);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .upload-zone:hover::before {
            width: 300px;
            height: 300px;
        }

        .upload-zone:hover {
            border-color: white;
            background: linear-gradient(135deg, #102848 0%, #1a3a5c 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(99, 102, 241, 0.2);
        }

        .upload-zone i {
            position: relative;
            z-index: 1;
            transition: all 0.3s ease;
            color: #a6a5b6;
        }

        .upload-zone:hover i {
            color: white;
            transform: scale(1.1) translateY(-5px);
        }

        .upload-zone p,
        .upload-zone small {
            position: relative;
            z-index: 1;
            transition: color 0.3s ease;
        }

        .upload-zone:hover p {
            color: #e2e8f0;
        }

        .upload-zone:hover small {
            color: #cbd5e0;
        }

        .upload-zone small {
            display: block;
            margin-top: 8px;
            opacity: 0.8;
        }

        .preview-frame {
            border: 3px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
            background: linear-gradient(to bottom, #f8f9fa, #ffffff);
            max-height: 600px;
            overflow-y: auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .color-picker-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .color-preview {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            border: 2px solid #ddd;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .color-preview:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Active/dragging state for upload zone */
        .upload-zone.dragging {
            border-color: white;
            background: linear-gradient(135deg, #1a3a5c 0%, #2d4f7a 100%);
            transform: scale(1.02);
        }

        .custom-button-card {
            background: #f8f9fa;
            border: 2px solid #dee2e6;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
            position: relative;
        }

        .custom-button-card:hover {
            border-color: #007bff;
            box-shadow: 0 6px 16px rgba(0, 123, 255, 0.15);
            transform: translateY(-2px);
        }

        .delete-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #dc3545;
            margin-right: auto;
            margin-left: auto;
            margin-bottom: 10px;
            color: white;
            border: none;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
        }

        .delete-btn:hover {
            background: #c82333;
            transform: scale(1.1);
        }

        .add-button-card {
            border: 3px dashed #28a745;
            background: linear-gradient(135deg, #f1f8f4 0%, #e6f4ea 100%);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .add-button-card:hover {
            border-color: #218838;
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            transform: translateY(-2px);
        }

        .scrollable {
            max-height: 800px;
            overflow: auto;

            /* For WebKit browsers (Chrome, Edge, Opera) */
            scrollbar-width: thin;
            /* For Firefox */
            scrollbar-color: #999 #202f4c;
            /* thumb + track */
        }
    </style>

    <!-- Header with Preview Toggle -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">
            <i class="fa fa-external-link-alt mx-2"></i>صفحات فصل الخدمة
        </h3>
        <div>
            @if (!empty($billingCode))
                <a class="btn btn-sm btn-warning" target="_blank"
                    href="{{ $activeTab === 'quta_expired' ? "/{$billingCode}/quta_expired.php" : "/{$billingCode}/time_expired.php" }}">
                    <i class="fa fa-external-link mx-2"></i>
                    معاينة خارجية
                </a>
            @endif
            <button type="button" class="btn btn-sm btn-info" wire:click="togglePreview">
                <i class="fa fa-eye mx-2"></i>
                {{ $showPreview ? 'إخفاء المعاينة' : 'عرض المعاينة' }}
            </button>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs mb-4" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{ $activeTab === 'time_expired' ? 'active' : '' }}"
                wire:click="$set('activeTab', 'time_expired')" style="cursor: pointer;">
                <i class="fa fa-clock mx-2"></i>صفحة انتهاء الوقت
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $activeTab === 'quta_expired' ? 'active' : '' }}"
                wire:click="$set('activeTab', 'quta_expired')" style="cursor: pointer;">
                <i class="fa fa-database mx-2"></i>صفحة انتهاء الكوته
            </a>
        </li>
    </ul>

    <div class="row" x-data="componentMikrotikRedirectSettings">

        <!-- Settings Column -->
        <div class="col-lg-{{ $showPreview ? 6 : 12 }}">
            <!-- Time Expired Settings Tab -->
            <div class="{{ $activeTab === 'time_expired' ? '' : 'd-none' }} scrollable">
                @include('livewire.admin.settings.include.time_expired_settings')
            </div>

            <!-- Quta Expired Settings Tab -->
            <div class="{{ $activeTab === 'quta_expired' ? '' : 'd-none' }} scrollable">
                @include('livewire.admin.settings.include.quta_expired_settings')
            </div>
        </div>

        <!-- Live Preview Column -->
        @if ($showPreview)
            <div class="col-lg-6">
                <div class="sticky-top" style="top: 20px;z-index:0!important;">
                    <div class="position-relative">
                        <div class="position-absolute  top-0 start-0 m-3" style="z-index: 1;">
                            <button class="btn btn-primary" wire:click="$refresh">
                                <i class="fa fa-refresh"></i>
                            </button>
                        </div>
                        @php
                            $previewImage = $activeTab === 'quta_expired'
                                ? ($quta_image_upload ? $quta_image_upload->temporaryUrl() : $quta_image_path)
                                : ($time_image_upload ? $time_image_upload->temporaryUrl() : $time_image_path);

                            $previewBackground = $activeTab === 'quta_expired'
                                ? ($quta_background_upload ? $quta_background_upload->temporaryUrl() : $quta_background_image)
                                : ($time_background_upload ? $time_background_upload->temporaryUrl() : $time_background_image);
                        @endphp

                        @if ($activeTab === 'quta_expired')
                            @include('mikrotik.redirect.expired_preview', [
                                'settings' => [
                                    'page_title' => $quta_page_title,
                                    'header_text' => $quta_header_text,
                                    'header_bg_color' => $quta_header_bg_color,
                                    'body_bg_color' => $quta_body_bg_color,

                                    'background_image' => $previewBackground,

                                    'main_message' => $quta_main_message,
                                    'secondary_message' => $quta_secondary_message,

                                    'show_progress_bar' => $quta_show_progress_bar,
                                    'progress_percentage' => $quta_progress_percentage,

                                    'show_image' => $quta_show_image,
                                    'image_path' => $previewImage,
                                    'image_size' => (int) ($quta_image_size ?? 100),

                                    'button_text' => $quta_button_text,
                                    'button_url' => $quta_button_url,
                                    'button_bg_color' => $quta_button_bg_color,

                                    'custom_buttons' => $quta_custom_buttons,
                                    'show_contact_info' => $quta_show_contact_info,
                                    'contact_phone' => $quta_contact_phone,
                                    'contact_email' => $quta_contact_email,
                                ],
                            ])
                        @else
                            @include('mikrotik.redirect.expired_preview', [
                                'settings' => [
                                    'page_title' => $time_page_title,
                                    'header_text' => $time_header_text,
                                    'header_bg_color' => $time_header_bg_color,
                                    'body_bg_color' => $time_body_bg_color,

                                    'background_image' => $previewBackground,

                                    'main_message' => $time_main_message,
                                    'secondary_message' => $time_secondary_message,

                                    'show_progress_bar' => false,
                                    'progress_percentage' => 100,

                                    'show_image' => $time_show_image,
                                    'image_path' => $previewImage,
                                    'image_size' => (int) ($time_image_size ?? 100),

                                    'button_text' => $time_button_text,
                                    'button_url' => $time_button_url,
                                    'button_bg_color' => $time_button_bg_color,

                                    'custom_buttons' => $time_custom_buttons,
                                    'show_contact_info' => $time_show_contact_info,
                                    'contact_phone' => $time_contact_phone,
                                    'contact_email' => $time_contact_email,
                                ],
                            ])
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="box-footer bg-light">
        <div class="d-flex justify-content-between gap-2">
            @if ($activeTab === 'quta_expired')
                <button type="button" class="btn btn-warning" wire:click="resetQutaExpiredToDefault">
                    <i class="fa fa-undo mx-2"></i>استعادة الافتراضي
                </button>
                <button type="button" wire:click.prevent="saveQutaExpiredSettings" class="btn btn-success px-4">
                    <i class="fa fa-save mx-2"></i>حفظ التغييرات
                </button>
            @else
                <button type="button" class="btn btn-warning" wire:click="resetTimeExpiredToDefault">
                    <i class="fa fa-undo mx-2"></i>استعادة الافتراضي
                </button>
                <button type="button" wire:click.prevent="saveTimeExpiredSettings" class="btn btn-success px-4">
                    <i class="fa fa-save mx-2"></i>حفظ التغييرات
                </button>
            @endif
        </div>
    </div>
    <!-- Loading Indicator -->
    <div wire:loading class="position-fixed top-50 start-50 translate-middle">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">جاري التحميل...</span>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // Handle file drag and drop
        document.addEventListener('DOMContentLoaded', function() {
            const uploadZones = document.querySelectorAll('.upload-zone');

            uploadZones.forEach(zone => {
                zone.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    this.style.borderColor = '#007bff';
                    this.style.background = '#e7f3ff';
                });

                zone.addEventListener('dragleave', function(e) {
                    e.preventDefault();
                    this.style.borderColor = '#ccc';
                    this.style.background = '#f8f9fa';
                });

                zone.addEventListener('drop', function(e) {
                    e.preventDefault();
                    this.style.borderColor = '#ccc';
                    this.style.background = '#f8f9fa';
                });
            });
        });

        // Auto-update color preview
        document.addEventListener('input', function(e) {
            if (e.target.type === 'color') {
                const wrapper = e.target.closest('.color-picker-wrapper');
                if (wrapper) {
                    const textInput = wrapper.querySelector('input[type="text"]');
                    if (textInput) {
                        textInput.value = e.target.value;
                    }
                }
            }
        });

        function componentMikrotikRedirectSettings() {
            return {
                confirmDeleteTimeCustomButtonBtn(index) {
                    let title = "هل أنت متأكد من حذف هذا الزر؟";
                    let text = "";
                    confirmWarningAlert(title, text, 'تأكيد').then((result) => {
                        if (result.isConfirmed) {
                            @this.call('removeTimeCustomButton', index)
                        }
                    });
                },
                confirmDeleteQutaCustomButtonBtn(index) {
                    let title = "هل أنت متأكد من حذف هذا الزر؟";
                    let text = "";
                    confirmWarningAlert(title, text, 'تأكيد').then((result) => {
                        if (result.isConfirmed) {
                            @this.call('removeQutaCustomButton', index)
                        }
                    });
                },
            };
        }
    </script>
@endpush
