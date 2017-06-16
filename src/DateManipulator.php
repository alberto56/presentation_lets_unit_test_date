<?php

/**
 * Groups functionality which manipulates dates.
 */
class DateManipulator {

  /**
   * Internal instance variable used with the instance() method.
   */
  static private $instance;

  /**
   * Implements the Singleton design pattern.
   *
   * Only one instance of this class should exist per execution.
   *
   * @return DateManipulator
   *   The single instance of this class.
   */
  static function instance() {
    if (!self::$instance) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  protected function __construct() {
    
  }

  /**
   * Given an end-date option, provide date1 and date2 from variables.
   *
   * @param string $option
   *   A from-to behaviour, value, value2, or anything else.
   * @param array $dates
   *   An array of dates.
   *
   * @return array
   *   An associative array with date1 and date2 for processing.
   */
  function startEndDates(string $option, array $dates) : array {
    switch ($option) {
      case 'value':
        $return['date1'] = $dates['value']['formatted'];
        $return['date2'] = $return['date1'];
        break;
      case 'value2':
        $return['date2'] = $dates['value2']['formatted'];
        $return['date1'] = $return['date2'];
        break;
      default:
        $return['date1'] = $dates['value']['formatted'];
        $return['date2'] = $dates['value2']['formatted'];
        break;
    }
    return $return;
  }

  /**
   * Calculate the repeat rule.
   *
   * Check the formatter settings to see if the repeat rule should be
   * displayed. Show it only with the first multiple value date.
   */
  public function calcRepeatRule($entity_type, $entity, &$repeating_ids, $item, $show_repeat_rule, $field) {
    if ($entity_type == '') {
      throw new Exception('Entity type cannot be NULL');
    }
    list($id) = $this->entityExtractIds($entity_type, $entity);
    if (!in_array($id, $repeating_ids) && $this->moduleExists('date_repeat_field') && !empty($item['rrule']) && $show_repeat_rule == 'show') {
      $repeat_vars = array(
        'field' => $field,
        'item' => $item,
        'entity_type' => $entity_type,
        'entity' => $entity,
      );
      $repeating_ids[] = $id;
      return $this->theme('date_repeat_display', $repeat_vars);
    }
  }

  protected function entityExtractIds($entity_type, $entity) {
    return entity_extract_ids($entity_type, $entity);
  }

  protected function moduleExists($module) {
    return module_exists($module);
  }

  protected function theme($hook, $variables) {
    return theme($hook, $variables);
  }

}
