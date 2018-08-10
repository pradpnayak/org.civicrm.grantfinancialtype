<?php

class CRM_Grant_BAO_Query_Grant extends CRM_Contact_BAO_Query_Interface {

  /**
   * static field for all the export/import hrjob fields
   *
   * @var array
   * @static
   */
  static $_fields = [];

  /**
   * Function get the import/export fields for hrjob
   *
   * @return array self::$_hrjobFields  associative array of hrjob fields
   * @static
   */
  public function &getFields() {
    return self::$_fields;
  }

  /**
   * @param $query
   *
   * @return null
   */
  public function select(&$query) {
    $query->_returnProperties['grant_financial_type'] = 1;
    $query->_select['grant_financial_type'] = "civicrm_financial_type.name as grant_financial_type";
    $query->_element['grant_financial_type'] = 1;
    $query->_tables['civicrm_grant'] = 1;
    $query->_tables['grant_financial_type'] = 1;
  }

  /**
   * @param $query
   *
   * @return null
   */
  public function where(&$query) {

    foreach ($query->_params as $params) {

      list($name, $op, $value, $grouping, $wildcard) = $params;
      if (empty($name)) {
        continue;
      }

      if ($name == 'grant_financial_type_id') {
        $query->_tables['grant_financial_type'] = 1;
        $query->_whereTables['grant_financial_type'] = 1;
        $query->_where[$grouping][] = CRM_Contact_BAO_Query::buildClause("civicrm_grant.financial_type_id", $op, $value, "Integer");
        list($qillop, $qillVal) = CRM_Contact_BAO_Query::buildQillForFieldValue('CRM_Grant_DAO_Grant', 'financial_type_id', $value, $op);
        $query->_qill[$grouping][] = ts("%1 %2 %3", array(1 => ts('Financial Type'), 2 => $qillop, 3 => $qillVal));
        $query->_tables['civicrm_grant'] = $query->_whereTables['civicrm_grant'] = 1;
        break;
      }
    }
  }

  /**
   * @param string $fieldName
   * @param $mode
   * @param $side
   *
   * @return mixed
   */
  public function from($name, $mode, $side) {
    $from = '';
    if ($name == 'grant_financial_type') {
      $from .= " $side JOIN civicrm_financial_type
        ON civicrm_grant.financial_type_id = civicrm_financial_type.id
      ";
    }
    return $from;
  }

  /**
   * @param $tables
   *
   * @return null
   */
  public function setTableDependency(&$tables) {
  }

  /**
   * @param $panes
   *
   * @return null
   */
  public function registerAdvancedSearchPane(&$panes) {
  }

  /**
   * @param $panes
   */
  public function getPanesMapper(&$panes) {
  }

  /**
   * @param CRM_Core_Form $form
   * @param $type
   *
   * @return null
   */
  public function buildAdvancedSearchPaneForm(&$form, $type) {
  }

  /**
   * @param $paneTemplatePathArray
   * @param $type
   *
   * @return null
   */
  public function setAdvancedSearchPaneTemplatePath(&$paneTemplatePathArray, $type) {
  }

  /**
   * Describe options for available for use in the search-builder.
   *
   * The search builder determines its options by examining the API metadata corresponding to each
   * search field. This approach assumes that each field has a unique-name (ie that the field's
   * unique-name in the API matches the unique-name in the search-builder).
   *
   * @param array $apiEntities
   *   List of entities whose options should be automatically scanned using API metadata.
   * @param array $fieldOptions
   *   Keys are field unique-names; values describe how to lookup the options.
   *   For boolean options, use value "yesno". For pseudoconstants/FKs, use the name of an API entity
   *   from which the metadata of the field may be queried. (Yes - that is a mouthful.)
   * @void
   */
  public function alterSearchBuilderOptions(&$apiEntities, &$fieldOptions) {
  }

}
