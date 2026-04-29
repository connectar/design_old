<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/printthermal_style.css')}}">
</head>

<body>
    <div class="ticket">
        {{-- <img src="./logo.png" alt="Logo"> --}}
        <p class="centered">{{$user->network->name ?? ''}}
            <br>{{$user->nas->name ?? ''}}
            <br>تليفون : {{$admin->phone ?? '---'}}
        </p>
        <table>
            <tbody>
                <tr>
                    <td class="description">تاريخ البدء</td>
                    <td class="description">{{now()->parse($invoice->started_at)->format('Y-m-d') ?? 'مؤجلة'}}</td>
                </tr>
                <tr>
                    <td class="description">تاريخ الانتهاء</td>
                    <td class="description">{{now()->parse($invoice->expired_at)->format('Y-m-d') ?? 'مؤجلة'}}</td>
                </tr>
                <tr>
                    <td class="description">رقم الفاتورة</td>
                    <td class="description">{{$invoice->id ?? ''}}</td>
                </tr>
                <tr>
                    <td class="description"> حالة الفاتورة</td>
                    <td class="description">@if($invoice->status ==1) مدفوعة @else غير مدفوعة @endif</td>
                </tr>
                <tr>
                    <td class="description">من</td>
                    <td class="description">{{$admin->fullname ?? ''}}</td>
                </tr>
                <tr>
                    <td class="description">الى</td>
                    <td class="description">{{$user->fullname ?? ''}}</td>
                </tr>
                <tr>
                    <td class="description">@if ($invoice->event_name=='add_quta') # @else العرض @endif</td>
                    <td class="description">
                        @if ($invoice->event_name=='add_quta')
                        شراء باقة اضافيه
                        @else
                        {{$user->offer->name ?? ''}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="description">المبلغ</td>
                    <td class="description">
                        @if ($invoice->event_name=='add_quta')
                        {{$invoice->price}}
                        @else
                        {{$user->offer->render()->price() ?? ''}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="description">الكوتة</td>
                    <td class="description">
                        @if ($invoice->event_name=='add_quta')
                        {{$invoice->content['quta'] ?? ''}}
                        @else
                        {{$user->offer->render()->quta() ?? ''}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="description">رصيد العميل</td>
                    <td class="description">{{$user->account ?? 0}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
<script>
    window.print();
</script>

</html>
