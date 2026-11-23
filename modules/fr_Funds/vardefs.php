<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

$dictionary['fr_Funds'] = [
    'table' => 'fr_funds',
    'audited' => true,
    'inline_edit' => true,
    'duplicate_merge' => true,
    'fields' => [
        'fund_code' => [
            'name' => 'fund_code',
            'vname' => 'LBL_FUND_CODE',
            'type' => 'varchar',
            'len' => 50,
            'required' => true,
            'audited' => true,
            'importable' => 'required',
        ],
        'gl_account_number' => [
            'name' => 'gl_account_number',
            'vname' => 'LBL_GL_ACCOUNT_NUMBER',
            'type' => 'varchar',
            'len' => 64,
            'audited' => true,
        ],
        'is_restricted' => [
            'name' => 'is_restricted',
            'vname' => 'LBL_IS_RESTRICTED',
            'type' => 'bool',
            'default' => '0',
            'audited' => true,
        ],
        'fund_status' => [
            'name' => 'fund_status',
            'vname' => 'LBL_FUND_STATUS',
            'type' => 'enum',
            'options' => 'fr_fund_status_list',
            'len' => 50,
            'default' => 'Active',
            'audited' => true,
        ],
        'target_amount' => [
            'name' => 'target_amount',
            'vname' => 'LBL_TARGET_AMOUNT',
            'type' => 'currency',
            'dbType' => 'decimal',
            'len' => '26,6',
            'audited' => true,
        ],
        'total_received' => [
            'name' => 'total_received',
            'vname' => 'LBL_TOTAL_RECEIVED',
            'type' => 'currency',
            'dbType' => 'decimal',
            'len' => '26,6',
            'default' => '0.000000',
            'readonly' => true,
        ],
        'currency_id' => [
            'name' => 'currency_id',
            'vname' => 'LBL_CURRENCY',
            'type' => 'currency_id',
            'dbType' => 'id',
            'group' => 'currency_id',
            'default' => '-99',
            'function' => [
                'name' => 'getCurrencyDropDown',
                'returns' => 'html',
                'onListView' => true,
            ],
        ],
        'donations' => [
            'name' => 'donations',
            'type' => 'link',
            'relationship' => 'fr_funds_fr_donations',
            'source' => 'non-db',
            'vname' => 'LBL_DONATIONS',
        ],
        'pledges' => [
            'name' => 'pledges',
            'type' => 'link',
            'relationship' => 'fr_funds_fr_pledges',
            'source' => 'non-db',
            'vname' => 'LBL_PLEDGES',
        ],
    ],
    'relationships' => [
        'fr_funds_fr_donations' => [
            'lhs_module' => 'fr_Funds',
            'lhs_table' => 'fr_funds',
            'lhs_key' => 'id',
            'rhs_module' => 'fr_Donations',
            'rhs_table' => 'fr_donations',
            'rhs_key' => 'fund_id',
            'relationship_type' => 'one-to-many',
        ],
        'fr_funds_fr_pledges' => [
            'lhs_module' => 'fr_Funds',
            'lhs_table' => 'fr_funds',
            'lhs_key' => 'id',
            'rhs_module' => 'fr_Pledges',
            'rhs_table' => 'fr_pledges',
            'rhs_key' => 'fund_id',
            'relationship_type' => 'one-to-many',
        ],
    ],
    'indices' => [
        [
            'name' => 'idx_fr_funds_code',
            'type' => 'unique',
            'fields' => ['fund_code', 'deleted'],
        ],
    ],
    'optimistic_locking' => true,
    'unified_search' => true,
];

if (!class_exists('VardefManager')) {
    require_once 'include/SugarObjects/VardefManager.php';
}

VardefManager::createVardef(
    'fr_Funds',
    'fr_Funds',
    ['basic', 'assignable', 'security_groups']
);