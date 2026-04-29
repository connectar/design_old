@php
    $currentBillingCode = null;
    try {
        $networkId = function_exists('getAuthNetworkId') ? (int) getAuthNetworkId() : 0;
        if ($networkId > 0) {
            $currentBillingCode = \App\Models\Network::withoutGlobalScopes()
                ->where('id', $networkId)
                ->value('billing_code');
        }
    } catch (\Throwable $e) {
        $currentBillingCode = null;
    }

    $variables = [
        [
            'name'        => '%COMMENT%',
            'description' => 'وصف متغير يستخدم لتعليقات واسماء معينة في النظام',
            'value'       => $microtikInstallComment,
        ],
        [
            'name'        => '%API_USERNAME%',
            'description' => 'اسم المستخدم الذي يتم استخدامه للوصول إلى واجهة البرمجة (API)',
            'value'       => \App\Models\Nas::getApiUsername(),
        ],
        [
            'name'        => '%API_PASSWORD%',
            'description' => 'كلمة مرور API المتغيرة التي يتم استخدامها للمصادقة عبر API',
            'value'       => 'متغيرة لكل سيرفر',
        ],
        [
            'name'        => '%IP_HOST%',
            'description' => 'عنوان IP الذي يتم استخدامه كمضيف للخدمة أو التطبيق',
            'value'       => $settings['ip_host'] ?? '-',
        ],
        [
            'name'        => '%RADIUS_SECRET%',
            'description' => 'كلمة سر سرية مستخدمة في بروتوكول RADIUS للمصادقة والترخيص',
            'value'       => \App\ENUMS\RadiusTypeEnum::getPassword(),
        ],
        [
            'name'        => '%RADIUS_IP%',
            'description' => 'عنوان IP للخادم RADIUS الذي يتم استخدامه للاتصالات',
            'value'       => $settings['radius']['ip'] ?? '-',
        ],
        [
            'name'        => '%RADIUS_IDLE%',
            'description' => 'وقت الخمول المسموح به قبل فقدان الاتصال في RADIUS',
            'value'       => $settings['radius']['idle'] ?? '-',
        ],
        [
            'name'        => '%RADIUS_INTERIM_UPDATE%',
            'description' => 'فترة تحديث الجلسات في RADIUS',
            'value'       => $settings['radius']['interim_update'] ?? '-',
        ],
        [
            'name'        => '%RADIUS_PORT%',
            'description' => 'منفذ خادم RADIUS المستخدم للاتصالات',
            'value'       => $settings['radius']['port'] ?? '-',
        ],
        [
            'name'        => '%VPN_IP%',
            'description' => 'عنوان IP المستخدم للاتصال بالشبكة الظاهرية الخاصة (VPN)',
            'value'       => $settings['vpn_ip'] ?? '-',
        ],
        [
            'name'        => '%NAS_SERIAL%',
            'description' => 'رقم التسلسل الفريد لجهاز الوصول الشبكي (NAS) المستخدم',
            'value'       => 'متغير لكل سيرفر',
        ],
        [
            'name'        => '%BILLING_CODE%',
            'description' => 'كود التحصيل الخاص بالشبكة — يُستخدم كاسم مجلد صفحات فصل الخدمة (logo / background / time_expired.php / quta_expired.php) تحت public/{billing_code}/',
            'value'       => $currentBillingCode ?: 'متغير لكل شبكة',
        ],
        [
            'name'        => '%ADDRESS_LIST_END_USER%',
            'description' => 'قائمة العناوين المستخدمة لمستخدمي السيرفرات',
            'value'       => \App\ENUMS\RadiusTypeEnum::ADDRESS_LIST_END_USER,
        ],
        [
            'name'        => '%ADDRESS_LIST_QUTA_EXPIRED%',
            'description' => 'قائمة العناوين المستخدمة للمستخدمين الذين انتهت صلاحيتهم',
            'value'       => \App\ENUMS\RadiusTypeEnum::ADDRESS_LIST_QUTA_EXPIRED,
        ],
        [
            'name'        => '%ADDRESS_LIST_BLOCK_PORN%',
            'description' => 'قائمة العناوين المستخدمة لحظر المواقع الإباحية',
            'value'       => \App\ENUMS\RadiusTypeEnum::ADDRESS_LIST_BLOCK_PORN,
        ],
        [
            'name'        => '%DOMAIN_NETWORK_HTTP%',
            'description' => 'عنوان النطاق المستخدم لسيرفر الشبكات',
            'value'       => $network_domain,
        ],
        [
            'name'        => '%DOMAIN_CAFE_HTTP%',
            'description' => 'عنوان النطاق المستخدم لسيرفر الكافيهات',
            'value'       => $cafe_domain,
        ],
        [
            'name'        => '%DOMAIN_SUDAN_HTTP%',
            'description' => 'عنوان النطاق المستخدم لسيرفر السودان',
            'value'       => $sudan_domain,
        ],
    ];
@endphp

<div class="col-md-12">
    <div class="box" style="background-color:#0c1422;border:1px solid #1f2d3f;">
        <div class="box-header with-border d-flex justify-content-between align-items-center"
            style="background-color:#0f1a2d;border-bottom:1px solid #1f2d3f;">
            <h4 class="box-title text-white mb-0">
                <i class="fa fa-list-alt mx-2 text-warning"></i>شرح المتغيرات
                <small class="text-muted">({{ count($variables) }} متغير)</small>
            </h4>
        </div>
        <div class="box-body p-0">
            <div class="variables-grid">
                @foreach ($variables as $var)
                    <div class="variable-card">
                        <span class="var-name">{{ $var['name'] }}</span>
                        <div class="var-desc">{{ $var['description'] }}</div>
                        <span class="var-value">{{ $var['value'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
