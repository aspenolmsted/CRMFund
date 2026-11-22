<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

global $mod_strings, $app_strings, $sugar_config;

if (ACLController::checkAccess('fr_Funds', 'edit', true)) {
    $module_menu[] = ['index.php?module=fr_Funds&action=EditView&return_module=fr_Funds&return_action=DetailView', $mod_strings['LNK_NEW_RECORD'], 'Add', 'fr_Funds'];
}
if (ACLController::checkAccess('fr_Funds', 'list', true)) {
    $module_menu[] = ['index.php?module=fr_Funds&action=index&return_module=fr_Funds&return_action=DetailView', $mod_strings['LNK_LIST'], 'List', 'fr_Funds'];
}