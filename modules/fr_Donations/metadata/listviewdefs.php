<?php
// modules/fr_Donations/metadata/listviewdefs.php
$listViewDefs['fr_Donations'] = [
    'NAME' => [
        'width' => '25%',
        'label' => 'LBL_NAME',
        'default' => true,
        'link' => true,
    ],
    'CONTACT_NAME' => [
        'width' => '20%',
        'label' => 'LBL_CONTACT_NAME',
        'id' => 'CONTACT_ID',
        'module' => 'Contacts',
        'default' => true,
        'link' => true,
    ],
    'FUND_NAME' => [
        'width' => '15%',
        'label' => 'LBL_FUND_NAME',
        'id' => 'FUND_ID',
        'module' => 'fr_Funds',
        'default' => true,
        'link' => true,
    ],
    'AMOUNT' => [
        'width' => '15%',
        'label' => 'LBL_AMOUNT',
        'default' => true,
    ],
    'DATE_RECEIVED' => [
        'width' => '15%',
        'label' => 'LBL_DATE_RECEIVED',
        'default' => true,
    ],
    'STATUS' => [
        'width' => '10%',
        'label' => 'LBL_STATUS',
        'default' => true,
    ],
];