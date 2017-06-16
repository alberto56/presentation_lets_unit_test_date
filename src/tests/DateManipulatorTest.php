<?php

use \PHPUnit\Framework\TestCase;
require_once('DateManipulator.php');

/**
 * @group custom
 */
class DateManipulatorTest extends TestCase {

  /**
   * @cover ::startEndDates
   * @dataProvider providerStartEndDates
   */
  public function testStartEndDates($value, $dates, $expected) {
    $object = new DateManipulator();

    $output = $object->startEndDates($value, $dates);
    $this->assertTrue($output == $expected);
  }

  public function providerStartEndDates() {
    return [
      [
        'value' => 'value',
        'dates' => ['value' => ['formatted' => 'whatever']],
        'expected' => [
          'date1' => 'whatever',
          'date2' => 'whatever',
        ],
      ],
      [
        'value' => 'value2',
        'dates' => ['value2' => ['formatted' => 'whatever']],
        'expected' => [
          'date1' => 'whatever',
          'date2' => 'whatever',
        ],
      ],
      [
        'value' => 'some-random-value',
        'dates' => [
          'value' => ['formatted' => 'first'],
          'value2' => ['formatted' => 'second'],
        ],
        'expected' => [
          'date1' => 'first',
          'date2' => 'second',
        ],
      ],
    ];
  }

}
