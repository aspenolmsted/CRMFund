<?php
// modules/fr_Donations/Menu.php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

global $mod_strings, $app_strings, $sugar_config;

if (ACLController::checkAccess('fr_Donations', 'edit', true)) {
    $module_menu[] = [
        'index.php?module=fr_Donations&action=EditView&return_module=fr_Donations&return_action=DetailView',
        $mod_strings['LNK_NEW_RECORD'],
        'Add',
        'fr_Donations',
    ];
}

if (ACLController::checkAccess('fr_Donations', 'list', true)) {
    $module_menu[] = [
        'index.php?module=fr_Donations&action=index&return_module=fr_Donations&return_action=DetailView',
        $mod_strings['LNK_LIST'],
        'List',
        'fr_Donations',
    ];
}

if (ACLController::checkAccess('fr_Donations', 'import', true)) {
    $module_menu[] = [
        'index.php?module=Import&action=Step1&import_module=fr_Donations&return_module=fr_Donations&return_action=index',
        $mod_strings['LNK_IMPORT_FR_DONATIONS'],
        'Import',
        'fr_Donations',
    ];
}