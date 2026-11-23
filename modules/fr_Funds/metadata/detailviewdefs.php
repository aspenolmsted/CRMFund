<?php
// modules/fr_Funds/metadata/detailviewdefs.php
$viewdefs['fr_Funds']['DetailView'] = [
    'templateMeta' => [
        'form' => [
            'buttons' => ['EDIT', 'DUPLICATE', 'DELETE'],
        ],
        'maxColumns' => '2',
        'widths' => [
            ['label' => '10', 'field' => '30'],
            ['label' => '10', 'field' => '30'],
        ],
    ],
    'panels' => [
        'default' => [
            ['name', 'fund_code'],
            ['gl_account_number', 'is_restricted'],
            ['fund_status', 'assigned_user_name'],
            ['target_amount', 'total_received'],
            ['description'],
        ],
    ],
];