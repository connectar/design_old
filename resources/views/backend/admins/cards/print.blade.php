<!DOCTYPE html>
<html lang="er">

<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'PT Sans', sans-serif;
            direction: rtl;
        }

        @page {
            size: 2.8in 11in;
            margin-top: 0cm;
            margin-left: 0cm;
            margin-right: 0cm;
        }

        table {
            width: 100%;
        }

        tr {
            width: 100%;

        }

        h1 {
            text-align: center;
            vertical-align: middle;
        }

        #logo {
            width: 60%;
            text-align: center;
            -webkit-align-content: center;
            align-content: center;
            padding: 5px;
            margin: 2px;
            display: block;
            margin: 0 auto;
        }

        header {
            width: 100%;
            text-align: center;
            -webkit-align-content: center;
            align-content: center;
            vertical-align: middle;
        }

        .items thead {
            text-align: center;
        }

        .center-align {
            text-align: center;
        }

        .bill-details td {
            font-size: 12px;
            text-align: center;
        }

        .receipt {
            font-size: medium;
        }

        .items .heading {
            font-size: 12.5px;
            text-transform: uppercase;
            border-top: 1px solid black;
            margin-bottom: 4px;
            border-bottom: 1px solid black;
            vertical-align: middle;
        }

        .items thead tr th:first-child,
        .items tbody tr td:first-child {
            width: 47%;
            min-width: 47%;
            max-width: 47%;
            word-break: break-all;
            text-align: left;
        }

        .items td {
            font-size: 12px;
            text-align: right;
            vertical-align: bottom;
        }

        .price::before {
            content: "\20B9";
            font-family: Arial;
            text-align: right;
        }

        .sum-up {
            text-align: right !important;
        }

        .total {
            font-size: 13px;
            border-top: 1px dashed black !important;
            border-bottom: 1px dashed black !important;
        }

        .line {
            border-top: 1px dashed black !important;
            width: 90%;
            margin: 0 auto;
        }

        .heading.rate {
            width: 20%;
        }

        .heading.amount {
            width: 25%;
        }

        .heading.qty {
            width: 5%
        }

        p {
            padding: 1px;
            margin: 0;
        }

        section,
        footer {
            font-size: 12px;
        }

        .title {
            z-index: 10;
            background-color: #fff;
            position: relative;
            padding: 0 10px;
        }

        .card_line {
            position: absolute;
            top: 9px;
            z-index: 1;
            left: 5%;
            right: 5%;
            margin: 0;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>
    @foreach ($data['cards'] as $card)
        <header>
            <div id="logo" class="media" data-src="logo.png" src="./logo.png"></div>
        </header>
        <p style="text-align: center">
            {{ $data['network_name'] }}
        </p>
        <p style="text-align: center;">
            {{ $data['nas_name'] }}
        </p>
        <div class="line"></div>
        <table class="bill-details">
            <tbody>
                <tr>
                    <th class="center-align" colspan="2" style="padding:10px 0;">
                        <span>سعر الكارت : </span>
                        <span class="receipt">{{ $card['price'] }}</span>
                        <span>{{getViewCurrency()}}</span>
                    </th>
                </tr>
                <tr>
                    <th style="">
                        <div style="position: relative;">
                            <span class="title">الرقم السرى</span>
                            <div class="line card_line"></div>
                        </div>
                    </th>
                </tr>
                @if ($card['isQrAllowed'] ?? false)
                    <tr>
                        <th style="padding-bottom: 5px;padding-top:8px;">
                            <span style="font-size: 25px">{!! $card['qrCode'] !!}</span>
                        </th>
                    </tr>
                @endif
                <tr>
                    <th style="padding-bottom: 5px;">
                        <span style="font-size: 25px">{{ $card['username'] }}</span>
                    </th>
                </tr>
            </tbody>
        </table>

        <div class="line"></div>

        <p style="text-align: center;margin-top:10px;font-size:17px;">
            <span>للتواصل :</span>
            <span>{{ $data['admin_phone'] }}</span>
        </p>
        <div class="page-break"></div>
    @endforeach
    <script>
        window.print();
    </script>
</body>

</html>
