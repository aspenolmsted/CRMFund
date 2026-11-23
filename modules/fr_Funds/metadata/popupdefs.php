<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

$popupMeta = [
    'moduleMain' => 'fr_Funds',
    'varName' => 'FR_FUNDS',
    'orderBy' => 'fr_funds.name',
    'whereClauses' => [
        'name' => 'fr_funds.name',
        'fund_code' => 'fr_funds.fund_code',
        'fund_status' => 'fr_funds.fund_status',
    ],
    'searchInputs' => [
        'name',
        'fund_code',
        'fund_status',
    ],
    'listviewdefs' => [
        'NAME' => [
            'width' => '40%',
            'label' => 'LBL_NAME',
            'link' => true,
            'default' => true,
        ],
        'FUND_CODE' => [
            'width' => '20%',
            'label' => 'LBL_FUND_CODE',
            'default' => true,
        ],
        'IS_RESTRICTED' => [
            'width' => '15%',
            'label' => 'LBL_IS_RESTRICTED',
            'default' => true,
        ],
        'FUND_STATUS' => [
            'width' => '25%',
            'label' => 'LBL_FUND_STATUS',
            'default' => true,
        ],
    ],
];