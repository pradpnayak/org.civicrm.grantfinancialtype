<?php

require_once 'grantfinancialtype.civix.php';
use CRM_Grantfinancialtype_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function grantfinancialtype_civicrm_config(&$config) {
  _grantfinancialtype_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function grantfinancialtype_civicrm_xmlMenu(&$files) {
  _grantfinancialtype_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function grantfinancialtype_civicrm_install() {
  _grantfinancialtype_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function grantfinancialtype_civicrm_postInstall() {
  _grantfinancialtype_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function grantfinancialtype_civicrm_uninstall() {
  _grantfinancialtype_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function grantfinancialtype_civicrm_enable() {
  _grantfinancialtype_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function grantfinancialtype_civicrm_disable() {
  _grantfinancialtype_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function grantfinancialtype_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _grantfinancialtype_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function grantfinancialtype_civicrm_managed(&$entities) {
  _grantfinancialtype_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function grantfinancialtype_civicrm_caseTypes(&$caseTypes) {
  _grantfinancialtype_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function grantfinancialtype_civicrm_angularModules(&$angularModules) {
  _grantfinancialtype_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function grantfinancialtype_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _grantfinancialtype_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_entityTypes
 */
function grantfinancialtype_civicrm_entityTypes(&$entityTypes) {
  _grantfinancialtype_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_buildForm().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_buildForm
 */
function grantfinancialtype_civicrm_buildForm($formName, &$form) {

  if (in_array($formName, ['CRM_Grant_Form_Grant', 'CRM_Grant_Form_Search'])) {
        // Check permissions for financial type first
    $financialTypes = [];
    CRM_Financial_BAO_FinancialType::getAvailableFinancialTypes($financialTypes, $form->_action);
    if (empty($financialTypes)) {
      CRM_Core_Error::statusBounce(ts('You do not have all the permissions needed for this page.'));
    }
    $attr = ['class' => 'crm-select2', 'placeholder' => ts('- select -')];
    $fieldName = 'financial_type_id';
    if ($formName == 'CRM_Grant_Form_Search') {
      $fieldName = 'grant_financial_type_id';
      $attr['multiple'] = 'multiple';
    }
    CRM_Core_Region::instance('page-body')->add([
      'template' => 'CRM/Grant/Form/GrantExtra.tpl',
    ]);
    $form->add('select', $fieldName,
      ts('Financial Type'),
      $financialTypes,
      FALSE,
      $attr
    );
  }
}

/**
 * Implements hook_civicrm_pageRun().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_pageRun
 */
function grantfinancialtype_civicrm_pageRun(&$page) {
  if (is_a($page, 'CRM_Grant_Page_Tab')) {
    CRM_Core_Region::instance('page-body')->add([
      'template' => 'CRM/Grant/Page/GrantExtra.tpl',
    ]);
  }
}

/**
 * Implements hook_civicrm_searchColumns().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_searchColumns
 */
function grantfinancialtype_civicrm_searchColumns($objectName, &$headers, &$rows, &$selector) {
  if ($objectName == 'grant') {
    $tempHeaders = [];
    foreach ($headers as $header) {
      $tempHeaders[] = $header;
      if (CRM_Utils_Array::value('sort', $header) == 'grant_type_id') {
        $tempHeaders[] = [
          'name' => ts('Financial Type'),
          //'sort' => 'grant_finacial_type',
          'direction' => CRM_Utils_Sort::DONTCARE,
        ];
      }
    }
    $headers = $tempHeaders;
  }
}

/**
 * Implements hook_civicrm_queryObjects().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_queryObjects
 */
function grantfinancialtype_civicrm_queryObjects(&$queryObjects, $type) {
  if ($type == 'Contact') {
    $queryObjects[] = new CRM_Grant_BAO_Query_Grant();
  }
}
