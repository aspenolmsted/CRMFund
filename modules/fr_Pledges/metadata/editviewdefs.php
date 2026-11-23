<?php
// modules/fr_Pledges/metadata/editviewdefs.php
$viewdefs['fr_Pledges']['EditView'] = [
    'templateMeta' => [
        'maxColumns' => '2',
        'widths' => [
            ['label' => '10', 'field' => '30'],
            ['label' => '10', 'field' => '30'],
        ],
    ],
    'panels' => [
        'default' => [
            ['name', 'status'],
            ['contact_name', 'account_name'],
            ['fund_name', 'campaign_name'],
            ['total_commitment', 'installment_amount'],
            ['frequency', 'next_billing_date'],
            ['start_date', 'end_date'],
            ['gateway_subscription_id', 'assigned_user_name'],
            ['description'],
        ],
    ],
];