@extends('backend.layouts.manger')
@section('content')
    hello posts
@endsection
@push('styles')
    <style>
        @media (max-width: 768px) {
            .mobile-display-block {
                display: block !important;
                line-height: 1.7;
                margin: 0px !important;

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
