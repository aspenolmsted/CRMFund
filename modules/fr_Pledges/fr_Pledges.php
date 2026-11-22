<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

class fr_Pledges extends Basic
{
    public $new_schema = true;
    public $module_dir = 'fr_Pledges';
    public $object_name = 'fr_Pledges';
    public $table_name = 'fr_pledges';
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

    public $total_commitment;
    public $installment_amount;
    public $amount_paid;
    public $balance_remaining;
    public $currency_id;
    public $frequency;
    public $status;
    public $start_date;
    public $next_billing_date;
    public $end_date;
    public $gateway_subscription_id;

    public $contact_id;
    public $contact_name;
    public $account_id;
    public $account_name;
    public $fund_id;
    public $fund_name;
    public $campaign_id;
    public $campaign_name;

    public function bean_implements($interface)
    {
        switch ($interface) {
            case 'ACL':
                return true;
        }
        return false;
    }
}