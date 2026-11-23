<?php
// modules/fr_Donations/metadata/editviewdefs.php
$viewdefs['fr_Donations']['EditView'] = [
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
            ['fund_name', 'pledge_name'],
            ['amount', 'tax_deductible_amount'],
            ['date_received', 'payment_method'],
            ['gift_type', 'transaction_id'],
            ['campaign_name', 'opportunity_name'],
            ['soft_credit_contact_name', 'is_anonymous'],
            ['receipt_sent_date', 'assigned_user_name'],
            ['description'],
        ],
    ],
];