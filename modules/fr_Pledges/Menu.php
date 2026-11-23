<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

global $mod_strings, $app_strings, $sugar_config;

if (ACLController::checkAccess('fr_Pledges', 'edit', true)) {
    $module_menu[] = [
        'index.php?module=fr_Pledges&action=EditView&return_module=fr_Pledges&return_action=DetailView',
        $mod_strings['LNK_NEW_RECORD'],
        'Add',
        'fr_Pledges',
    ];
}

if (ACLController::checkAccess('fr_Pledges', 'list', true)) {
    $module_menu[] = [
        'index.php?module=fr_Pledges&action=index&return_module=fr_Pledges&return_action=DetailView',
        $mod_strings['LNK_LIST'],
        'List',
        'fr_Pledges',
    ];
}

if (ACLController::checkAccess('fr_Pledges', 'import', true)) {
    $module_menu[] = [
        'index.php?module=Import&action=Step1&import_module=fr_Pledges&return_module=fr_Pledges&return_action=index',
        $mod_strings['LNK_IMPORT_FR_PLEDGES'],
        'Import',
        'fr_Pledges',
    ];
}