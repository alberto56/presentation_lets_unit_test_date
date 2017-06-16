<?php

/**
 * Groups functionality which manipulates dates.
 */
class DateManipulator {

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

}
