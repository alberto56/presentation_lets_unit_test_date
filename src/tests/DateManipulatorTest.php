<?php

use \PHPUnit\Framework\TestCase;
require_once('DateManipulator.php');

/**
 * @group custom
 */
class DateManipulatorTest extends TestCase {

  /**
   * @cover ::startEndDates
   */
  public function testStartEndDates() {
    $object = new DateManipulator();

    $value = 'value';
    $dates['value']['formatted'] = 'whatever';
    $expected = array(
      'date1' => 'whatever',
      'date2' => 'whatever',
    );
    $output = $object->startEndDates($value, $dates);
    $this->assertTrue($output == $expected);
  }

}
