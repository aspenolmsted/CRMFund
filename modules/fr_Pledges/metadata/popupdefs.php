<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

$popupMeta = [
    'moduleMain' => 'fr_Pledges',
    'varName' => 'FR_PLEDGES',
    'orderBy' => 'fr_pledges.name',
    'whereClauses' => [
        'name' => 'fr_pledges.name',
        'status' => 'fr_pledges.status',
    ],
    'searchInputs' => [
        'name',
        'status',
    ],
    'listviewdefs' => [
        'NAME' => [
            'width' => '35%',
            'label' => 'LBL_NAME',
            'link' => true,
            'default' => true,
        ],
        'CONTACT_NAME' => [
            'width' => '25%',
            'label' => 'LBL_CONTACT_NAME',
            'default' => true,
        ],
        'INSTALLMENT_AMOUNT' => [
            'width' => '20%',
            'label' => 'LBL_INSTALLMENT_AMOUNT',
            'default' => true,
        ],
        'STATUS' => [
            'width' => '20%',
            'label' => 'LBL_STATUS',
            'default' => true,
        ],
    ],
];