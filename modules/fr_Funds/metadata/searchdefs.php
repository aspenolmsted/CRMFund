<?php

$searchdefs['fr_Funds'] = [
    'templateMeta' => [
        'maxColumns' => '3',
        'maxColumnsBasic' => '3',
        'widths' => [
            'label' => '10',
            'field' => '30',
        ],
    ],
    'layout' => [
        'basic_search' => [
            'name',
            'fund_code',
            'fund_status',
        ],
        'advanced_search' => [
            'name',
            'fund_code',
            'gl_account_number',
            'is_restricted',
            'fund_status',
            'assigned_user_id',
        ],
    ],
];