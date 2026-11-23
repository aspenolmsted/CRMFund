<?php

$viewdefs['fr_Funds']['EditView'] = [
    'templateMeta' => [
        'maxColumns' => '2',
        'widths' => [
            ['label' => '10', 'field' => '30'],
            ['label' => '10', 'field' => '30'],
        ],
        'useTabs' => false,
    ],
    'panels' => [
        'default' => [
            [
                'name',
                'fund_code',
            ],
            [
                'gl_account_number',
                'is_restricted',
            ],
            [
                'fund_status',
                'assigned_user_name',
            ],
            [
                'target_amount',
                'currency_id',
            ],
            [
                'description',
            ],
        ],
    ],
];