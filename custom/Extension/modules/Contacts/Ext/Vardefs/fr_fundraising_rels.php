<?php
// custom/Extension/modules/Contacts/Ext/Vardefs/fr_fundraising_rels.php

$dictionary['Contact']['fields']['fr_donations'] = [
    'name' => 'fr_donations',
    'type' => 'link',
    'relationship' => 'contacts_fr_donations',
    'source' => 'non-db',
    'vname' => 'LBL_FR_DONATIONS',
];

$dictionary['Contact']['fields']['fr_soft_credit_donations'] = [
    'name' => 'fr_soft_credit_donations',
    'type' => 'link',
    'relationship' => 'soft_credit_contacts_fr_donations',
    'source' => 'non-db',
    'vname' => 'LBL_FR_SOFT_CREDIT_DONATIONS',
];

$dictionary['Contact']['fields']['fr_pledges'] = [
    'name' => 'fr_pledges',
    'type' => 'link',
    'relationship' => 'contacts_fr_pledges',
    'source' => 'non-db',
    'vname' => 'LBL_FR_PLEDGES',
];

$dictionary['Contact']['relationships']['contacts_fr_donations'] = [
    'lhs_module' => 'Contacts',
    'lhs_table' => 'contacts',
    'lhs_key' => 'id',
    'rhs_module' => 'fr_Donations',
    'rhs_table' => 'fr_donations',
    'rhs_key' => 'contact_id',
    'relationship_type' => 'one-to-many',
];

$dictionary['Contact']['relationships']['soft_credit_contacts_fr_donations'] = [
    'lhs_module' => 'Contacts',
    'lhs_table' => 'contacts',
    'lhs_key' => 'id',
    'rhs_module' => 'fr_Donations',
    'rhs_table' => 'fr_donations',
    'rhs_key' => 'soft_credit_contact_id',
    'relationship_type' => 'one-to-many',
];

$dictionary['Contact']['relationships']['contacts_fr_pledges'] = [
    'lhs_module' => 'Contacts',
    'lhs_table' => 'contacts',
    'lhs_key' => 'id',
    'rhs_module' => 'fr_Pledges',
    'rhs_table' => 'fr_pledges',
    'rhs_key' => 'contact_id',
    'relationship_type' => 'one-to-many',
];