@extends('backend.layouts.manger')
@section('content')
    <livewire:questions.manager.answers.create-answer-for-question :question="$question" />
@endsection

@push('styles')
    <style>
        p,
        .ck-editor-custom p,
        .ck-editor-custom ul,
        .ck-editor-custom li,
        .ck-editor-custom ol,
        .ck-editor-custom ol li strong,
        {
        word-break: break-word;
        word-wrap: break-word;
        }

        .ck-editor-custom h1,
        .ck-editor-custom h2,
        .ck-editor-custom h3,
        .ck-editor-custom h4,
        .ck-editor-custom h5,
        .ck-editor-custom h6 {
            color: rgb(221, 170, 15) !important;
            word-break: break-word;
            word-wrap: break-word;
        }

        @media (max-width: 768px) {
            .mobile-display-block {
                display: block !important;
                line-height: 1.7;
                margin: 0px !important;

            }

            .custom-margin-mobile {
                margin: 0px !important;
                padding: 0px !important;
            }

            .custom-display-grid {
                display: grid;
            }

            .custom-display-block {
                display: block !important;
            }

            .custom-display-none {
                display: none !important;
            }

            .custom-margin-top-goback-btn {
                margin-top: 20px;
            }

            .custom-margin-none {
                margin: 4px !important;
            }

            .custom-padding-none {
                padding: 0px !important;
            }

            .custom-display-grid-list {
                display: grid !important;
                grid-template-columns: 1fr 1fr 1fr;
                grid-row-gap: 5px;
            }
        }

        /* Custom card class */
        .custom-card {
            transition: box-shadow 0.5s, transform 0.3s;
            /* Add a smooth transition for box-shadow and transform effects */
        }

        /* Add a subtle box-shadow on hover */
        .custom-card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            transform: translateY(-5px);
            /* Move the card up slightly on hover */
        }

        .ck-editor__editable {
            min-height: 200px;
            max-height: 400px;
            overflow-y: auto;
            color: rgb(26, 26, 26);
            font-size: 14px;
        }

        .ck-content h2,
        .ck-content h3,
        .ck-content h4,
        .ck-content h5,
        .ck-content h6 {
            color: rgb(26, 26, 26) !important;
        }
    </style>
@endpush

@push('scripts')
    <script async charset="utf-8" src="//cdn.embedly.com/widgets/platform.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
@endpush
