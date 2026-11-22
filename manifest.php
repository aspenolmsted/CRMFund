<?php

$manifest = [
    'acceptable_sugar_versions' => [
        'regex_matches' => [
            '^6\.5\.[0-9]+$',            
            '^7\.[0-9]+\.[0-9]+$',
            '^8\.[0-9]+\.[0-9]+$',
        ],
    ],
    'acceptable_sugar_flavors' => [
        'CE',
        'PRO',
        'ENT',
    ],
    'readme' => 'README.md',
    'key' => 'fr_fundraising_ext',
    'author' => 'Aspen Olmsted',
    'description' => 'Fundraising and donor management extension for SuiteCRM adding Donations (fr_Donations), Funds (fr_Funds), and Pledges (fr_Pledges) along with native module relationships and donor rollups.',
    'icon' => '',
    'is_uninstallable' => true,
    'name' => 'SuiteCRM Fundraising Extension',
    'published_date' => '2026-11-22 16:00:00',
    'type' => 'module',
    'version' => '1.0.3',
    'remove_tables' => 'prompt',
];

$installdefs = [
    'id' => 'fr_fundraising_ext',

    // 1. Register Custom Beans & Modules
    'beans' => [
        [
            'module' => 'fr_Funds',
            'class' => 'fr_Funds',
            'path' => 'modules/fr_Funds/fr_Funds.php',
            'tab' => true,
        ],
        [
            'module' => 'fr_Pledges',
            'class' => 'fr_Pledges',
            'path' => 'modules/fr_Pledges/fr_Pledges.php',
            'tab' => true,
        ],
        [
            'module' => 'fr_Donations',
            'class' => 'fr_Donations',
            'path' => 'modules/fr_Donations/fr_Donations.php',
            'tab' => true,
        ],
    ],

    // 2. Copy Module Directories & Custom Extensions
    'copy' => [
        [
            'from' => '<basepath>/modules/fr_Funds',
            'to' => 'modules/fr_Funds',
        ],
        [
            'from' => '<basepath>/modules/fr_Pledges',
            'to' => 'modules/fr_Pledges',
        ],
        [
            'from' => '<basepath>/modules/fr_Donations',
            'to' => 'modules/fr_Donations',
        ],
        [
            'from' => '<basepath>/custom/Extension/modules/Contacts',
            'to' => 'custom/Extension/modules/Contacts',
        ],
    ],

    // 3. Language Strings & Dropdown Lists
    'language' => [
        [
            'from' => '<basepath>/custom/Extension/application/Ext/Language/en_us.fr_fundraising.php',
            'to_module' => 'application',
            'language' => 'en_us',
        ],
        [
            'from' => '<basepath>/custom/Extension/modules/Contacts/Ext/Language/en_us.fr_fundraising.php',
            'to_module' => 'Contacts',
            'language' => 'en_us',
        ],
        [
            'from' => '<basepath>/custom/Extension/modules/Accounts/Ext/Language/en_us.fr_fundraising.php',
            'to_module' => 'Accounts',
            'language' => 'en_us',
        ],
        [
            'from' => '<basepath>/custom/Extension/modules/Campaigns/Ext/Language/en_us.fr_fundraising.php',
            'to_module' => 'Campaigns',
            'language' => 'en_us',
        ],
        [
            'from' => '<basepath>/custom/Extension/modules/Opportunities/Ext/Language/en_us.fr_fundraising.php',
            'to_module' => 'Opportunities',
            'language' => 'en_us',
        ],
    ],

    // 4. Logic Hooks (Donor, Campaign, Fund, and Pledge Rollups)
    'logic_hooks' => [
        [
            'module' => 'fr_Donations',
            'hook' => 'after_save',
            'order' => 10,
            'description' => 'Recalculate donor, account, campaign, fund, and pledge totals after saving a donation',
            'file' => 'modules/fr_Donations/DonorRollupHook.php',
            'class' => 'DonorRollupHook',
            'function' => 'updateRollupsOnSave',
        ],
        [
            'module' => 'fr_Donations',
            'hook' => 'after_delete',
            'order' => 10,
            'description' => 'Recalculate donor, account, campaign, fund, and pledge totals after deleting a donation',
            'file' => 'modules/fr_Donations/DonorRollupHook.php',
            'class' => 'DonorRollupHook',
            'function' => 'updateRollupsOnDelete',
        ],
    ],

    // 5. Custom Fields on Native Modules (Contacts, Accounts, Campaigns, Opportunities)
    'custom_fields' => [
        // Contacts
        [
            'name' => 'donor_status_c',
            'label' => 'LBL_DONOR_STATUS',
            'type' => 'enum',
            'module' => 'Contacts',
            'ext1' => 'fr_donor_status_list',
            'default_value' => 'Prospect',
            'audited' => true,
        ],
        [
            'name' => 'lifetime_giving_c',
            'label' => 'LBL_LIFETIME_GIVING',
            'type' => 'currency',
            'module' => 'Contacts',
            'default_value' => '0.00',
            'readonly' => true,
        ],
        [
            'name' => 'largest_gift_c',
            'label' => 'LBL_LARGEST_GIFT',
            'type' => 'currency',
            'module' => 'Contacts',
            'default_value' => '0.00',
            'readonly' => true,
        ],
        [
            'name' => 'last_gift_date_c',
            'label' => 'LBL_LAST_GIFT_DATE',
            'type' => 'date',
            'module' => 'Contacts',
            'readonly' => true,
        ],
        [
            'name' => 'tax_receipt_pref_c',
            'label' => 'LBL_TAX_RECEIPT_PREF',
            'type' => 'enum',
            'module' => 'Contacts',
            'ext1' => 'fr_tax_receipt_pref_list',
            'default_value' => 'Email',
        ],
        [
            'name' => 'anonymous_donor_c',
            'label' => 'LBL_ANONYMOUS_DONOR',
            'type' => 'bool',
            'module' => 'Contacts',
            'default_value' => '0',
        ],

        // Accounts
        [
            'name' => 'org_type_c',
            'label' => 'LBL_ORG_TYPE',
            'type' => 'enum',
            'module' => 'Accounts',
            'ext1' => 'fr_org_type_list',
            'default_value' => 'Household',
        ],
        [
            'name' => 'matching_gift_ratio_c',
            'label' => 'LBL_MATCHING_GIFT_RATIO',
            'type' => 'decimal',
            'len' => '5,2',
            'module' => 'Accounts',
            'default_value' => '1.00',
        ],
        [
            'name' => 'grant_cycle_c',
            'label' => 'LBL_GRANT_CYCLE',
            'type' => 'varchar',
            'len' => 100,
            'module' => 'Accounts',
        ],
        [
            'name' => 'lifetime_giving_c',
            'label' => 'LBL_LIFETIME_GIVING',
            'type' => 'currency',
            'module' => 'Accounts',
            'default_value' => '0.00',
            'readonly' => true,
        ],

        // Campaigns
        [
            'name' => 'fundraising_goal_c',
            'label' => 'LBL_FUNDRAISING_GOAL',
            'type' => 'currency',
            'module' => 'Campaigns',
            'default_value' => '0.00',
        ],
        [
            'name' => 'total_pledged_c',
            'label' => 'LBL_TOTAL_PLEDGED',
            'type' => 'currency',
            'module' => 'Campaigns',
            'default_value' => '0.00',
            'readonly' => true,
        ],
        [
            'name' => 'total_received_c',
            'label' => 'LBL_TOTAL_RECEIVED',
            'type' => 'currency',
            'module' => 'Campaigns',
            'default_value' => '0.00',
            'readonly' => true,
        ],
        [
            'name' => 'appeal_code_c',
            'label' => 'LBL_APPEAL_CODE',
            'type' => 'varchar',
            'len' => 50,
            'module' => 'Campaigns',
        ],

        // Opportunities
        [
            'name' => 'grant_deadline_c',
            'label' => 'LBL_GRANT_DEADLINE',
            'type' => 'date',
            'module' => 'Opportunities',
        ],
        [
            'name' => 'installment_count_c',
            'label' => 'LBL_INSTALLMENT_COUNT',
            'type' => 'int',
            'module' => 'Opportunities',
            'default_value' => '1',
        ],
    ],
];