<!doctype html>
<html dir="rtl" lang="ar" class="no-js">

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width" />

<link rel="stylesheet" href="{{asset('css/print_style.css')}}" media="screen" />
<link rel="stylesheet" href="{{asset('css/print_style.css')}}" media="print" />

<!-- js HTML class -->
<script>
    (function (H) {
		H.className = H.className.replace(/\bno-js\b/, 'js')
	})(document.documentElement)
</script>

</head>

<body>
    @for ($i=0;$i<$total;$i++) <div class="invoice invoice{{$i+1}} @if($invoice->status ==1) paid @else unpaid @endif">
        <header class="header">
            <table class="main_table">
                <tr>
                    <td>
                        <div class="">
                            <h1>
                                {{$user->network->name ?? ''}}
                            </h1>
                            <p>
                                {{$user->nas->name ?? ''}}
                            </p>
                            <p>تليفون : {{$admin->phone ?? '---'}}</p>
                        </div>
                    </td>
                    <td>
                        <table class="second_table">
                            <tr>
                                <td>رقم الفاتورة</td>
                                <td>{{$invoice->id ?? ''}}</td>
                            </tr>
                            <tr>
                                <td>تاريخ الفاتورة</td>
                                <td>
                                    {{now()->parse($invoice->started_at)->format('Y-m-d') ?? 'مؤجلة'}}
                                </td>
                            </tr>
                            <tr>
                                <td>تاريخ الانتهاء</td>
                                <td>
                                    {{now()->parse($invoice->expired_at)->format('Y-m-d') ?? 'مؤجلة'}}
                                </td>
                            </tr>
                            <tr>
                                <td>المنطقة</td>
                                <td>
                                    {{$user->city}}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

        </header>
        <!-- e: invoice header -->
        <section class="parties">
            <table>
                <tr>
                    <td>
                        <div class="invoice-to">
                            <h2>فاتوره إلى:</h2>
                            <div id="hcard-Hiram-Roth" class="vcard">
                                <div class="">
                                    {{$user->fullname}}
                                </div>
                            </div><!-- e: vcard -->
                        </div><!-- e invoice-to -->
                    </td>
                    <td>
                        <div class="invoice-from">
                            <h2>فاتوره من:</h2>
                            <div id="hcard-Admiral-Valdore" class="vcard">
                                <div class="org">
                                    {{$admin->fullname}}
                                </div>
                            </div><!-- e: vcard -->
                        </div><!-- e invoice-from -->
                    </td>
                    <td>
                        <div class="invoice-status">
                            <h3>حالة الفاتورة</h3>
                            <strong>الفاتورة <em>
                                    @if($invoice->status ==1) مدفوعة @else غير مدفوعة @endif
                                </em>
                            </strong>
                        </div>
                    </td>
                </tr>
            </table>

        </section> <!-- e: invoice partis -->

        <section class="invoice-financials">

            <div class="invoice-items">
                <table>
                    <thead>
                        <tr>
                            @if ($invoice->event_name=='add_quta')
                            <th>#</th>
                            @else
                            <th>اسم العرض</th>
                            @endif
                            <th>الجيجات</th>
                            <th>السعر </th>
                            <th>الرصيد </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                @if ($invoice->event_name=='add_quta')
                                شراء باقة اضافيه
                                @else
                                {{$user->offer->name ?? ''}}
                                @endif
                            </td>
                            <td>
                                @if ($invoice->event_name=='add_quta')
                                {{$invoice->content['quta'] ?? ''}}
                                @else
                                {{$user->offer->render()->quta() ?? ''}}
                                @endif
                            </td>
                            <td>
                                @if ($invoice->event_name=='add_quta')
                                {{$invoice->price}}
                                @else
                                {{$user->offer->render()->price() ?? ''}}
                                @endif
                            </td>
                            <td>
                                {{$user->account ?? '0'}}
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div><!-- e: invoice items -->
            <div class="put_content">
                التوقيع :
            </div>
        </section>
        </div>
        @endfor
</body>
<script>
    window.print();
</script>

</html>
