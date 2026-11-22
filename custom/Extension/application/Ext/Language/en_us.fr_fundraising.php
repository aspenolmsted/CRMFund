<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

// Module Navigation & Plural Display Labels
$app_list_strings['moduleList']['fr_Funds'] = 'Funds';
$app_list_strings['moduleList']['fr_Pledges'] = 'Pledges';
$app_list_strings['moduleList']['fr_Donations'] = 'Donations';

// Module Singular Display Labels (used in Create menus, Subpanels, and Dashlets)
$app_list_strings['moduleListSingular']['fr_Funds'] = 'Fund';
$app_list_strings['moduleListSingular']['fr_Pledges'] = 'Pledge';
$app_list_strings['moduleListSingular']['fr_Donations'] = 'Donation';

// fr_Funds: Status Dropdown
$app_list_strings['fr_fund_status_list'] = [
    'Active' => 'Active',
    'Inactive' => 'Inactive',
    'Closed' => 'Closed',
];

// fr_Pledges: Frequency Dropdown
$app_list_strings['fr_pledge_frequency_list'] = [
    'Monthly' => 'Monthly',
    'Quarterly' => 'Quarterly',
    'Semi-Annually' => 'Semi-Annually',
    'Annually' => 'Annually',
];

// fr_Pledges: Status Dropdown
$app_list_strings['fr_pledge_status_list'] = [
    'Active' => 'Active',
    'Paused' => 'Paused',
    'Completed' => 'Completed',
    'Cancelled' => 'Cancelled',
    'Defaulted' => 'Defaulted',
];

// fr_Donations: Status Dropdown
$app_list_strings['fr_donation_status_list'] = [
    'Pending' => 'Pending',
    'Completed' => 'Completed',
    'Failed' => 'Failed',
    'Refunded' => 'Refunded',
    'Voided' => 'Voided',
];

// fr_Donations: Gift Type Dropdown
$app_list_strings['fr_gift_type_list'] = [
    'One-Time' => 'One-Time',
    'Recurring Installment' => 'Recurring Installment',
    'Pledge Payment' => 'Pledge Payment',
    'Matching' => 'Matching Gift',
    'In-Kind' => 'In-Kind',
];

// fr_Donations: Payment Method Dropdown
$app_list_strings['fr_payment_method_list'] = [
    'Credit Card' => 'Credit Card',
    'ACH' => 'ACH / Bank Transfer',
    'Check' => 'Check',
    'Cash' => 'Cash',
    'DAF' => 'Donor-Advised Fund (DAF)',
    'Stock' => 'Stock / Securities',
    'Wire' => 'Wire Transfer',
];

// Contacts: Donor Status Dropdown
$app_list_strings['fr_donor_status_list'] = [
    'Prospect' => 'Prospect',
    'Active' => 'Active',
    'Lapsed' => 'Lapsed',
    'Major' => 'Major Donor',
    'Do Not Solicit' => 'Do Not Solicit',
];

// Contacts: Tax Receipt Preference Dropdown
$app_list_strings['fr_tax_receipt_pref_list'] = [
    'Email' => 'Email (Per Gift)',
    'Annual Summary' => 'Annual Consolidated Summary',
    'Mail' => 'Postal Mail',
    'None' => 'None',
];

// Accounts: Organization Type Dropdown
$app_list_strings['fr_org_type_list'] = [
    'Household' => 'Household',
    'Foundation' => 'Foundation',
    'Corporate' => 'Corporate Sponsor',
    'DAF' => 'Donor-Advised Fund',
    'Government' => 'Government / Municipal',
];