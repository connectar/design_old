<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Document</title>
    <style>
        .page-break {
            page-break-after: always;
        }

        @page {
            margin: 0;
            padding: 0;
        }

        table {
            border-collapse: collapse;
            display: table;
            padding: 0;
        }

        .first_row {
            margin-top: 0 !important;
        }

        table td:last-child {
            border-right: none;
        }

        table tr:last-child td {
            border-bottom: none;
        }

        .last_row {
            margin-bottom: 0;
            border-bottom: none !important;
        }

        .serial {
            font-weight: bold;
            font-family: "Cairo", sans-serif !important;
        }
    </style>
    <style>
        .card_container {
            background: url("{{ $style['card_background'] }}") no-repeat;
            background-size: 100% 100%;
        }
    </style>
</head>

<body style="{{ $style['bodyStyle'] }}">
    <table>
        @foreach ($cards as $index => $array)
            @php
                if ($colNumber == 1) {
                    echo '<tr>';
                }

            @endphp
            <td class="@if ($rowNumber == 1) first_row @elseif($rowNumber == $totalRows) last_row @endif"
                style="{{ $style['tdStyle'] }}">
                <div style="{{ $style['columnsStyle'][$colNumber] }} o"
                    class="card_container @if ($rowNumber == 1) first_row @elseif($rowNumber == $totalRows)last_row @endif">

                    <span style="{{ $style['serialStyle'] }}" class="serial">
                        {{ $array['username'] }}
                    </span>
                    @if (array_key_exists('qr', $array))
                        <img src="data:image/png;base64,  {!! $array['qr'] !!}" style="{{ $style['qrStyle'] }}">
                    @endif

                    <span style="{{ $style['priceStyle'] }}" class="serial">
                        {{ $array['price'] }}
                    </span>
                </div>
            </td>
            @php
                if ($colNumber == $totalColumns) {
                    echo '</tr>';
                    $colNumber = 1;
                    $rowNumber++;
                } else {
                    $colNumber++;
                }

                if ($rowNumber > $totalRows) {
                    $rowNumber = 1;
                }
            @endphp
        @endforeach

    </table>

</body>

</html>
