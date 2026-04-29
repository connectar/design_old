<?php

return [

    'admin_sidebar' => [
        [
            'id' => 1,
            'label' => 'الرئيسية',
            'visible' => true,
            'children' => [],
            'index' => 0,
        ],
        [
            'id' => 2,
            'label' => 'حساب كونكت',
            'visible' => true,
            'children' => [],
            'index' => 1,
        ],
        [
            'id' => 3,
            'label' => 'فتح الاجهزة',
            'visible' => true,
            'index' => 2,
            'children' => [
                [
                    'id' => 3001,
                    'label' => 'الاجهزة',
                    'visible' => true,
                    'index' => 0,
                ],
                [
                    'id' => 3002,
                    'label' => 'اجهزة البرودباند',
                    'visible' => true,
                    'index' => 1,
                ],
            ],
        ],
        [
            'id' => 4,
            'label' => 'الخريطة',
            'visible' => true,
            'index' => 3,
            'children' => [],
        ],
        [
            'id' => 5,
            'label' => 'الرسائل',
            'visible' => true,
            'index' => 4,
            'children' => [
                [
                    'id' => 5001,
                    'label' => 'SMS والوتساب',
                    'visible' => true,
                    'index' => 0,
                ],
                [
                    'id' => 5002,
                    'label' => 'التليجرام والتطبيق',
                    'visible' => true,
                    'index' => 1,
                ],
            ],
        ],
        [
            'id' => 6,
            'label' => 'الاحصائيات',
            'visible' => true,
            'index' => 5,
            'children' => [
                [
                    'id' => 6001,
                    'label' => 'المشتركين',
                    'visible' => true,
                    'index' => 0,
                ],
                [
                    'id' => 6002,
                    'label' => 'السيرفرات',
                    'visible' => true,
                    'index' => 1,
                ],
            ],
        ],
        [
            'id' => 7,
            'label' => 'الحسابات المالية',
            'visible' => true,
            'index' => 6,
            'children' => [
                [
                    'id' => 7001,
                    'label' => 'المصروفات',
                    'visible' => true,
                    'index' => 0,
                ],
                [
                    'id' => 7002,
                    'label' => 'المتأخرات',
                    'visible' => true,
                    'index' => 1,
                ],
                [
                    'id' => 7003,
                    'label' => 'الفواتير والارباح',
                    'visible' => true,
                    'index' => 2,
                ],
            ],
        ],
        [
            'id' => 8,
            'label' => 'المديرين',
            'visible' => true,
            'index' => 7,
            'children' => [
                [
                    'id' => 8001,
                    'label' => 'كل المديرين',
                    'visible' => true,
                    'index' => 0,
                ],
                [
                    'id' => 8002,
                    'label' => 'اضافة مدير جديد',
                    'visible' => true,
                    'index' => 1,
                ],
                [
                    'id' => 8003,
                    'label' => 'سلة المهملات',
                    'visible' => true,
                    'index' => 2,
                ],
            ],
        ],
        [
            'id' => 9,
            'label' => 'السيرفرات',
            'visible' => true,
            'index' => 8,
            'children' => [
                [
                    'id' => 9001,
                    'label' => 'كل السيرفرات',
                    'visible' => true,
                    'index' => 0,
                ],
                [
                    'id' => 9002,
                    'label' => 'اضافة سيرفر جديد',
                    'visible' => true,
                    'index' => 1,
                ],
                [
                    'id' => 9003,
                    'label' => 'سلة المهملات',
                    'visible' => true,
                    'index' => 2,
                ],
            ],
        ],
        [
            'id' => 10,
            'label' => 'العروض',
            'visible' => true,
            'index' => 9,
            'children' => [
                [
                    'id' => 10001,
                    'label' => 'كل العروض',
                    'visible' => true,
                    'index' => 0,
                ],
                [
                    'id' => 10002,
                    'label' => 'اضافة عرض جديد',
                    'visible' => true,
                    'index' => 1,
                ],
                [
                    'id' => 10003,
                    'label' => 'الكوته',
                    'visible' => true,
                    'index' => 2,
                ],
            ],
        ],
        [
            'id' => 11,
            'label' => 'المشتركين',
            'visible' => true,
            'index' => 10,
            'children' => [
                [
                    'id' => 11001,
                    'label' => 'المشتركين الاونلاين',
                    'visible' => true,
                    'index' => 0,
                ],
                [
                    'id' => 11002,
                    'label' => 'كل المشتركين',
                    'visible' => true,
                    'index' => 1,
                ],
                [
                    'id' => 11003,
                    'label' => 'اضافة مشترك جديد',
                    'visible' => true,
                    'index' => 2,
                ],
                [
                    'id' => 11004,
                    'label' => 'سلة المهملات',
                    'visible' => true,
                    'index' => 3,
                ],
            ],
        ],
        [
            'id' => 12,
            'label' => 'سجل المدفوعات',
            'visible' => true,
            'index' => 11,
            'children' => [
                [
                    'id' => 12001,
                    'label' => 'المشتركين',
                    'visible' => true,
                    'index' => 0,
                ],
                [
                    'id' => 12002,
                    'label' => 'التحويلات',
                    'visible' => true,
                    'index' => 1,
                ],
            ],
        ],
        [
            'id' => 13,
            'label' => 'سجل التعديلات',
            'visible' => true,
            'index' => 12,
            'children' => [
                [
                    'id' => 13001,
                    'label' => 'المشتركين',
                    'visible' => true,
                    'index' => 0,
                ],
                [
                    'id' => 13002,
                    'label' => 'حركة الرصيد',
                    'visible' => true,
                    'index' => 1,
                ],
            ],
        ],
        [
            'id' => 14,
            'label' => 'كروت الهوتسبوت',
            'visible' => true,
            'index' => 13,
            'children' => [
                [
                    'id' => 14001,
                    'label' => 'الكروت الاونلاين',
                    'visible' => true,
                    'index' => 0,
                ],
                [
                    'id' => 14002,
                    'label' => 'كل الحزم',
                    'visible' => true,
                    'index' => 1,
                ],
                [
                    'id' => 14003,
                    'label' => 'كل الكروت',
                    'visible' => true,
                    'index' => 2,
                ],
                [
                    'id' => 14004,
                    'label' => 'اضافة حزمة جديدة',
                    'visible' => true,
                    'index' => 3,
                ],
                [
                    'id' => 14005,
                    'label' => 'تصاميم الكروت',
                    'visible' => true,
                    'index' => 4,
                ],
            ],
        ],
        [
            'id' => 15,
            'label' => 'كروت شحن الرصيد',
            'visible' => true,
            'index' => 14,
            'children' => [
                [
                    'id' => 15001,
                    'label' => 'كل الحزم',
                    'visible' => true,
                    'index' => 0,
                ],
                [
                    'id' => 15002,
                    'label' => 'كل الكروت',
                    'visible' => true,
                    'index' => 1,
                ],
                [
                    'id' => 15003,
                    'label' => 'اضافة حزمة جديدة',
                    'visible' => true,
                    'index' => 2,
                ],
            ],
        ],
        [
            'id' => 16,
            'label' => 'الموزعين',
            'visible' => true,
            'index' => 15,
            'children' => [
                [
                    'id' => 16001,
                    'label' => 'كل الموزعين',
                    'visible' => true,
                    'index' => 0,
                ],
                [
                    'id' => 16002,
                    'label' => 'اضافة موزع جديد',
                    'visible' => true,
                    'index' => 1,
                ],
                [
                    'id' => 16003,
                    'label' => 'سلة المهملات',
                    'visible' => true,
                    'index' => 2,
                ],
            ],
        ],
        [
            'id' => 17,
            'label' => 'الدعم الفني',
            'visible' => true,
            'index' => 16,
            'children' => [
                [
                    'id' => 17001,
                    'label' => 'التذاكر المرسلة',
                    'visible' => true,
                    'index' => 0,
                ],
                [
                    'id' => 17002,
                    'label' => 'ارسال تذكرة',
                    'visible' => true,
                    'index' => 1,
                ],
            ],
        ],
    ],

    'mapped_sidebar_data' => [
        [
            'id' => 1,
            'route_name' => 'admins.statistic.index',
            'icon' => 'fa fa-desktop p-0 mx-1',
            'label' => 'menu.admin_menu.home_title',
            'children' => [],
        ],
        [
            'id' => 2,
            'route_name' => 'admins.account',
            'icon' => 'fa fa-suitcase p-0 mx-1',
            'label' => 'menu.admin_menu.account',
            'children' => [],
        ],
        [
            'id' => 3,
            'route_name' => '',
            'icon' => 'fa fa-podcast p-0 mx-1',
            'label' => 'menu.admin_menu.dnat_devices_title',
            'children' => [
                [
                    'id' => 3001,
                    'route_name' => 'admins.dnat.devices.index',
                    'icon' => 'fa fa-wifi',
                    'label' => 'menu.admin_menu.dnat_devices_receivers_title',
                ],
                [
                    'id' => 3002,
                    'route_name' => 'admins.dnat.devices.broadband',
                    'icon' => '  fa fa-signal',
                    'label' => 'menu.admin_menu.dnat_devices_broadband_title',
                ],
            ],
        ],
        [
            'id' => 4,
            'route_name' => 'admins.devices.map',
            'icon' => 'fa fa-map p-0 mx-1',
            'label' => 'menu.admin_menu.map',
            'children' => [],
        ],
        [
            'id' => 5,
            'route_name' => '',
            'icon' => 'fa fa-envelope p-0 mx-1',
            'label' => 'menu.admin_menu.track_message',
            'children' => [
                [
                    'id' => 5001,
                    'route_name' => 'admins.track.messages',
                    'icon' => 'fa fa-whatsapp',
                    'label' => 'menu.admin_menu.track_message_whatsapp_sms',
                ],
                [
                    'id' => 5002,
                    'route_name' => 'admins.messages.index',
                    'icon' => 'fa fa-paper-plane',
                    'label' => 'menu.admin_menu.track_message_telegram',
                ],
            ],
        ],
        [
            'id' => 6,
            'route_name' => '',
            'icon' => 'fa fa-bar-chart p-0 mx-1',
            'label' => 'menu.admin_menu.statistic_title',
            'children' => [
                [
                    'id' => 6001,
                    'route_name' => 'admins.statistic.users',
                    'icon' => 'fa fa-users',
                    'label' => 'menu.admin_menu.statistic.users',
                ],
                [
                    'id' => 6002,
                    'route_name' => 'admins.statistic.nas',
                    'icon' => 'fa fa-server',
                    'label' => 'menu.admin_menu.statistic.nas',
                ],
            ],
        ],
        [
            'id' => 7,
            'route_name' => '',
            'icon' => 'fa fa-bank p-0 mx-1',
            'label' => 'menu.admin_menu.financial_accounts_title',
            'children' => [
                [
                    'id' => 7001,
                    'route_name' => 'admins.statistic.expenses',
                    'icon' => 'fa fa-money',
                    'label' => 'menu.admin_menu.statistic.expenses',
                ],
                [
                    'id' => 7002,
                    'route_name' => 'admins.statistic.debts',
                    'icon' => 'fa fa-exclamation-triangle',
                    'label' => 'new_trans.new_debts.title',
                ],
                [
                    'id' => 7003,
                    'route_name' => 'admins.statistic.invoices',
                    'icon' => 'fa fa-file-text-o',
                    'label' => 'menu.admin_menu.statistic.invoices_and_profits',
                ],
            ],
        ],
        [
            'id' => 8,
            'route_name' => '',
            'icon' => 'fa fa-group p-0 mx-1',
            'label' => 'menu.admin_menu.admins_title',
            'children' => [
                [
                    'id' => 8001,
                    'route_name' => 'admins.index',
                    'icon' => 'fa fa-list',
                    'label' => 'menu.admin_menu.admins.all',
                ],
                [
                    'id' => 8002,
                    'route_name' => 'admins.create',
                    'icon' => 'fa fa-plus-circle',
                    'label' => 'menu.admin_menu.admins.create',
                ],
                [
                    'id' => 8003,
                    'route_name' => 'admins.trashed',
                    'icon' => 'fa fa-trash-o',
                    'label' => 'menu.manager_menu.trashed',
                ],
            ],
        ],
        [
            'id' => 9,
            'route_name' => 'admins.nas.index',
            'icon' => 'fa fa-server p-0 mx-1',
            'label' => 'menu.admin_menu.servers_title',
            'children' => [
                [
                    'id' => 9001,
                    'route_name' => 'admins.nas.index',
                    'icon' => 'fa fa-list',
                    'label' => 'menu.admin_menu.servers.all',
                ],
                [
                    'id' => 9002,
                    'route_name' => 'admins.nas.create',
                    'icon' => 'fa fa-plus-circle',
                    'label' => 'menu.admin_menu.servers.create',
                ],
                [
                    'id' => 9003,
                    'route_name' => 'admins.nas.trashed',
                    'icon' => 'fa fa-trash-o',
                    'label' => 'menu.manager_menu.trashed',
                ],
            ],
        ],
        [
            'id' => 10,
            'route_name' => 'admins.offers.index',
            'icon' => 'fa fa-handshake-o p-0 mx-1',
            'label' => 'menu.admin_menu.offers_title',
            'children' => [
                [
                    'id' => 10001,
                    'route_name' => 'admins.offers.index',
                    'icon' => 'fa fa-list',
                    'label' => 'menu.admin_menu.offers.all',
                ],
                [
                    'id' => 10002,
                    'route_name' => 'admins.offers.create',
                    'icon' => 'fa fa-plus-circle',
                    'label' => 'menu.admin_menu.offers.create',
                ],
                [
                    'id' => 10003,
                    'route_name' => 'admins.quta.index',
                    'icon' => 'fa fa-tachometer',
                    'label' => 'menu.admin_menu.offers.quta',
                ],
                [
                    'id' => 10004,
                    'route_name' => 'admins.offers.trashed',
                    'icon' => 'fa fa-trash-o',
                    'label' => 'menu.manager_menu.trashed',
                ],
            ],
        ],
        [
            'id' => 11,
            'route_name' => 'admins.users.index',
            'icon' => 'fa fa-user-circle p-0 mx-1',
            'label' => 'menu.admin_menu.users_title',
            'children' => [
                [
                    'id' => 11001,
                    'route_name' => 'admins.users.online',
                    'icon' => 'fa fa-wifi',
                    'label' => 'menu.admin_menu.users.online',
                ],
                [
                    'id' => 11002,
                    'route_name' => 'admins.users.index',
                    'icon' => 'fa fa-list',
                    'label' => 'menu.admin_menu.users.all',
                ],
                [
                    'id' => 11003,
                    'route_name' => 'admins.users.create',
                    'icon' => 'fa fa-plus-circle',
                    'label' => 'menu.admin_menu.users.create',
                ],
                [
                    'id' => 11004,
                    'route_name' => 'admins.users.trashed',
                    'icon' => 'fa fa-trash-o',
                    'label' => 'menu.manager_menu.trashed',
                ],
            ],
        ],
        [
            'id' => 12,
            'route_name' => 'admins.invoices.users',
            'icon' => 'fa fa-file-text p-0 mx-1',
            'label' => 'menu.admin_menu.invoices_title',
            'children' => [
                [
                    'id' => 12001,
                    'route_name' => 'admins.invoices.users',
                    'icon' => 'fa fa-file-text-o',
                    'label' => 'menu.admin_menu.invoices.users',
                ],
                [
                    "id" => 12001,
                    "route_name" => "admins.invoices.transactions",
                    "icon" => "fa fa-credit-card",
                    "label" => "menu.admin_menu.invoices.transactions",
                ],
            ],
        ],
        [
            'id' => 13,
            'route_name' => 'admins.logs.users',
            'icon' => 'fa fa-history p-0 mx-1',
            'label' => 'menu.admin_menu.logs_title',
            'children' => [
                [
                    'id' => 13001,
                    'route_name' => 'admins.logs.users',
                    'icon' => 'fa fa-users',
                    'label' => 'menu.admin_menu.logs.users',
                ],
                [
                    'id' => 13002,
                    'route_name' => 'admins.logs.distributors',
                    'icon' => 'fa fa-address-book-o',
                    'label' => 'menu.admin_menu.logs.distributors',
                ],
            ],
        ],
        [
            'id' => 14,
            'route_name' => 'admins.users.index',
            'icon' => 'fa fa-id-card p-0 mx-1',
            'label' => 'menu.admin_menu.cards.title',
            'children' => [
                [
                    'id' => 14001,
                    'route_name' => 'admins.cards.online',
                    'icon' => 'fa fa-wifi',
                    'label' => 'menu.admin_menu.cards.online_cards',
                ],
                [
                    'id' => 14002,
                    'route_name' => 'admins.cards.groups.index',
                    'icon' => 'fa fa-th-list',
                    'label' => 'menu.admin_menu.cards.all_groups',
                ],
                [
                    'id' => 14003,
                    'route_name' => 'admins.cards.users.index',
                    'icon' => 'fa fa-list',
                    'label' => 'menu.admin_menu.cards.all_cards',
                ],
                [
                    'id' => 14004,
                    'route_name' => 'admins.cards.create',
                    'icon' => 'fa fa-plus-circle',
                    'label' => 'menu.admin_menu.cards.create',
                ],
                [
                    'id' => 14005,
                    'route_name' => 'admins.cards.design.index',
                    'icon' => 'fa fa-paint-brush',
                    'label' => 'menu.admin_menu.cards.designs',
                ],
                [
                    'id' => 14006,
                    'route_name' => 'admins.cards.users.trashed',
                    'icon' => 'fa fa-trash-o',
                    'label' => 'menu.manager_menu.trashed',
                ],
            ],
        ],
        [
            'id' => 15,
            'route_name' => 'admins.charging.index',
            'icon' => 'fa fa-money p-0 mx-1',
            'label' => 'menu.admin_menu.charging.title',
            'children' => [
                [
                    'id' => 15001,
                    'route_name' => 'admins.charging.index',
                    'icon' => 'fa fa-th-list',
                    'label' => 'menu.admin_menu.charging.all_groups',
                ],
                [
                    'id' => 15002,
                    'route_name' => 'admins.cards.charging.index',
                    'icon' => 'fa fa-list',
                    'label' => 'menu.admin_menu.cards.all_cards',
                ],
                [
                    'id' => 15003,
                    'route_name' => 'admins.charging.create',
                    'icon' => 'fa fa-plus-circle',
                    'label' => 'menu.admin_menu.cards.create',
                ],
                [
                    'id' => 15004,
                    'route_name' => 'admins.cards.charging.trashed',
                    'icon' => 'fa fa-trash-o',
                    'label' => 'menu.manager_menu.trashed',
                ],
            ],
        ],
        [
            'id' => 16,
            'route_name' => 'admins.distributors.index',
            'icon' => 'fa fa-address-book p-0 mx-1',
            'label' => 'menu.admin_menu.distributors_title',
            'children' => [
                [
                    'id' => 16001,
                    'route_name' => 'admins.distributors.index',
                    'icon' => 'fa fa-list',
                    'label' => 'menu.admin_menu.distributors.all',
                ],
                [
                    'id' => 16002,
                    'route_name' => 'admins.distributors.create',
                    'icon' => 'fa fa-plus-circle',
                    'label' => 'menu.admin_menu.distributors.create',
                ],
                [
                    'id' => 16003,
                    'route_name' => 'admins.distributors.trashed',
                    'icon' => 'fa fa-trash-o',
                    'label' => 'menu.manager_menu.trashed',
                ],
            ],
        ],
        [
            'id' => 17,
            'route_name' => 'admins.tickets.create',
            'icon' => 'fa fa-ticket m-0 p-1',
            'label' => 'menu.tickets.index',
            'children' => [
                [
                    'id' => 17001,
                    'route_name' => 'admins.tickets.index',
                    'icon' => 'fa fa-envelope px-2',
                    'label' => 'menu.tickets.mytickets',
                ],
                [
                    'id' => 17002,
                    'route_name' => 'admins.tickets.create',
                    'icon' => 'fa fa-paper-plane px-2',
                    'label' => 'menu.tickets.create',
                ],
            ],
        ],
    ],
    'manager_only_routes' => [
        [
            'id' => 10,
            'route_name' => 'admins.offer-import.index',
            'label' => 'datatable.upload_new_user',
            'icon' => 'fa fa-upload',
        ],
        [
            'id' => 11,
            'route_name' => 'admins.user-import.index',
            'label' => 'datatable.upload_new_user',
            'icon' => 'fa fa-upload',
        ],
        // [
        //     'id' => 12,
        //     'route_name' => 'admins.invoices.transactions',
        //     'icon' => 'fa fa-credit-card',
        //     'label' => 'menu.admin_menu.invoices.transactions',
        // ],
        [
            'id' => 14,
            'route_name' => 'admins.card-import.index',
            'label' => 'datatable.upload_new_user',
            'icon' => 'fa fa-upload',
        ],
        [
            'id' => 15,
            'route_name' => 'admins.card-import.index',
            'route_params' => [
                'charge',
            ],
            'label' => 'datatable.upload_new_user',
            'icon' => 'fa fa-upload',
        ],

    ],
];
