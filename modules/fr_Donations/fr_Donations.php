<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

class fr_Donations extends Basic
{
    public $new_schema = true;
    public $module_dir = 'fr_Donations';
    public $object_name = 'fr_Donations';
    public $table_name = 'fr_donations';
    public $importable = true;

    public $id;
    public $name;
    public $date_entered;
    public $date_modified;
    public $modified_user_id;
    public $modified_by_name;
    public $created_by;
    public $created_by_name;
    public $description;
    public $deleted;
    public $assigned_user_id;
    public $assigned_user_name;

    public $amount;
    public $tax_deductible_amount;
    public $currency_id;
    public $date_received;
    public $status;
    public $gift_type;
    public $payment_method;
    public $transaction_id;
    public $is_anonymous;
    public $receipt_sent_date;

    public $contact_id;
    public $contact_name;
    public $soft_credit_contact_id;
    public $soft_credit_contact_name;
    public $account_id;
    public $account_name;
    public $fund_id;
    public $fund_name;
    public $pledge_id;
    public $pledge_name;
    public $campaign_id;
    public $campaign_name;
    public $opportunity_id;
    public $opportunity_name;

    public function bean_implements($interface)
    {
        switch ($interface) {
            case 'ACL':
                return true;
        }
        return false;
    }
}