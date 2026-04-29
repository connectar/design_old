<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor_components/bootstrap/dist/css/bootstrap.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/vendor_components/bootstrap-select/dist/css/bootstrap-select.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/ibm_fonts.css') }}">
<!-- Style-->
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css?id=' . $updatedCode ?? '65874568') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/vendor_components/perfect-scrollbar/css/perfect-scrollbar.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/skin_color.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor_components/flexslider/flexslider.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/vendor_components/lightbox-master/dist/ekko-lightbox.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor_components/datatable/datatables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/vendor_components/c3/c3.min.css') }}">

<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/vendor_plugins/timepicker/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css?id=' . $updatedCode ?? '65874568') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/cairo_fonts.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/sidebar_icons.css?v=' . ($updatedCode ?? '1')) }}">
<style>
    .whatsapp_float,
    .support_float {
        position: fixed;
        width: 40px;
        /* make container big enough */
        height: 40px;
        bottom: 40px;
        left: 40px;
        border-radius: 50%;
        text-align: center;
        display: flex;
        /* center icon */
        align-items: center;
        justify-content: center;
        font-size: 28px;
        /* adjust icon size */
        color: white !important;
        z-index: 100;
        box-shadow: 2px 2px 3px #999;
    }

    .support_float {
        bottom: 100px !important;
        /* slightly above whatsapp */
        background-color: #ffa800;
        box-shadow: none;
        text-decoration: none;
    }

    /* Specific colors */
    .whatsapp_float:not(.support_float) {
        background-color: #25d366;
    }

    .whatsapp-icon {
        margin-top: 16px;
    }

    .iti {
        direction: ltr;
        text-align: left;
    }

    /* for mobile */
    @media screen and (max-width: 767px) {
        .whatsapp-icon {
            margin-top: 10px;
        }

        .whatsapp_float {
            width: 40px;
            height: 40px;
            bottom: 20px;
            left: 10px;
            font-size: 22px;
        }

        .support_float {
            line-height: 40px;
            bottom: 60px !important;
        }
    }

    .msg_setting_sec input[type="checkbox"] {
        right: unset !important;
        left: unset !important;
        opacity: 1 !important;
        margin: 3px -15px;
    }

    .msg_setting_sec .sub_btn {
        text-align: center;
        margin-bottom: 15px;
    }

    .default_checkbox {
        right: 0px !important;
        opacity: 1 !important;
        position: relative !important;
    }

    .notify_input_sec {
        display: flex;
        align-items: center;
        display: flex;
        align-items: center;
        background: #172b4c;
        justify-content: center;
        padding: 7px 0;
        border-radius: 5px;
        border: 1px solid #2f2e2e;
    }

    @media (max-width: 575.98px) {
        .setting_tab {
            height: calc(100% - 150px);
            overflow-y: scroll;
        }

        .notify_popup {}
    }

    .notify_sec {
        background: rgba(0, 0, 0, .5);
        height: 100vh;
        position: fixed;
        width: 100%;
        right: 0;
        left: 0;
        bottom: 0;
        top: 0;
        z-index: 999;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .notify_popup {
        background: #202f4c;
        width: 50%;
        padding: 0;
        box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
        border-radius: 5px;
        text-align: center;
    }
</style>
