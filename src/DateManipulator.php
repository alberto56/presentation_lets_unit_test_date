<?php

/**
 * Groups functionality which manipulates dates.
 */
class DateManipulator {

  use DateEnvironmentTrait;
  use DateSingletonTrait;

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

}
