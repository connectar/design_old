@extends('frontend.theme_two.master')

@section('content')
    <section id="custom-plans">
        @livewire('frontend.register-form', ['plan' => $plan, 'network_using' => $network_using, 'countries' => $countries, 'governorates' => $governorates])
    </section>
@endsection

@push('styles')
    @livewireStyles
    @livewireScripts
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .custom-error {
            color: red;
            font-size: 14px;
            display: flex;
            padding: 4px 15px;
        }

        .grid-container {
            display: grid;
            gap: 20px;
            /* Adjust the gap between columns */
        }

        @media (min-width: 768px) {
            .grid-container {
                grid-template-columns: 1fr 1fr;
            }
        }

        /* Basic reset and styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Styling for input container */
        .input-container {
            position: relative;
            display: flex;
            justify-content: center;
            margin-bottom: 15px;
        }

        /* Styling for input element */
        .custom-input {
            width: 450px;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            height: 45px !important;
            font-family: changa;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }


        /* Styling for input label */
        .custom-label {
            position: absolute;
            top: -9px;
            right: 2vw;
            background-color: #ffffff;
            padding: 0 5px;
            font-size: 14px;
            color: #999;
            transition: transform 0.2s ease-out, font-size 0.2s ease-out;
        }

        /* Input focus styles */
        .custom-input:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        /* Input label animation on focus */
        .custom-input:focus+.custom-label,
        .custom-input:not(:placeholder-shown)+.custom-label {
            transform: translateY(-10px);
            font-size: 12px;
            background-color: #ffffff;
        }


        #custom-plans {
            padding-top: 30px;
            padding-bottom: 30px;
            min-height: 77vh;
            background-color: #e9c12a;
            color: white;
        }

        #custom-plans-container {
            background-color: white;
            padding: 40px;
            padding-top: 60px;
            padding-bottom: 60px;
            max-width: 60%;
            display: flex;
            justify-content: center;
            margin: auto;
            border-radius: 10px;
            box-shadow: -10px 10px 15px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .custom-input {
                width: 100%;
            }

            #custom-plans-container {
                max-width: 95%;
                width: full;
            }

        }
    </style>
@endpush


@push('scripts')
    @include('sweetalert::alert')
    @include('backend.includes.scripts.main_js')
@endpush
