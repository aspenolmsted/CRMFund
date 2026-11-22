<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

class fr_Funds extends Basic
{
    public $new_schema = true;
    public $module_dir = 'fr_Funds';
    public $object_name = 'fr_Funds';
    public $table_name = 'fr_funds';
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

    public $fund_code;
    public $gl_account_number;
    public $is_restricted;
    public $fund_status;
    public $target_amount;
    public $total_received;
    public $currency_id;

    public function bean_implements($interface)
    {
        switch ($interface) {
            case 'ACL':
                return true;
        }
        return false;
    }
}