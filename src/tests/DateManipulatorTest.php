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
    $output = DateManipulator::instance()->startEndDates($value, $dates);
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

  /**
   * @cover ::calcRepeatRule
   * @dataProvider providerCalcRepeatRule
   */
  public function testCalcRepeatRule($message, $ids, $module_exists, $repeating_ids, $rule, $expected) {
    $object = $this->getMockBuilder(DateManipulator::class)
      ->disableOriginalConstructor()
      ->setMethods([
        'entityExtractIds',
        'moduleExists',
        'theme',
      ])
      ->getMock();
    $object->method('entityExtractIds')
      ->willReturn($ids);
    $object->method('moduleExists')
      ->willReturn($module_exists);
    $object->method('theme')
      ->willReturn('result-of-theme-hook');

    $output = $object->calcRepeatRule('entity_type', 'whatever', $repeating_ids, ['rrule' => 'exists'], $rule, 'field');
    $this->assertTrue($output == $expected, $message);
  }

  public function providerCalcRepeatRule() {
    return [
      [
        'message' => 'If ID in repeating ids, return NULL',
        'ids' => [123],
        'module_exists' => TRUE,
        'repeating_ids' => [123, 234, 456, 789],
        'rule' => 'show',
        'expected' => NULL,
      ],
      [
        'message' => 'If repeat module does not exist, return NULL',
        'ids' => [123],
        'module_exists' => FALSE,
        'repeating_ids' => [234, 456, 789],
        'rule' => 'show',
        'expected' => NULL,
      ],
      [
        'message' => 'If rule is not show, return NULL',
        'ids' => [123],
        'module_exists' => TRUE,
        'repeating_ids' => [234, 456, 789],
        'rule' => 'this-is-not-show',
        'expected' => NULL,
      ],
      [
        'message' => 'If all conditions are met, return result of theme hook',
        'ids' => [123],
        'module_exists' => TRUE,
        'repeating_ids' => [234, 456, 789],
        'rule' => 'show',
        'expected' => 'result-of-theme-hook',
      ],
    ];
  }

  /**
   * @cover ::calcRepeatRule
   */
  public function testCalcRepeatRuleException() {
    $this->expectException(Exception::class);
    $repeating_ids = 'whatever';
    DateManipulator::instance()->calcRepeatRule('', 'whatever', $repeating_ids, 'whatever', 'whatever', 'whatever');
  }

  /**
   * @cover ::calcRepeatRule
   * @dataProvider providerCalcRepeatRuleCallModuleExists
   */
  public function testCalcRepeatRuleCallModuleExists($ids, $repeating_ids, $call_module_exists) {
    $object = $this->getMockBuilder(DateManipulator::class)
      ->disableOriginalConstructor()
      ->setMethods([
        'entityExtractIds',
        'moduleExists',
      ])
      ->getMock();
    $object->method('entityExtractIds')
      ->willReturn($ids);

    $object->expects($call_module_exists ? $this->once() : $this->never())
       ->method('moduleExists');

    $output = $object->calcRepeatRule('entity_type', 'whatever', $repeating_ids, 'whatever', 'whatever', 'field');
  }

  public function providerCalcRepeatRuleCallModuleExists() {
    return [
      [
        'ids' => [1],
        'repeating_ids' => [1],
        'call_module_exists' => FALSE,
      ],
      [
        'ids' => [1],
        'repeating_ids' => [2],
        'call_module_exists' => TRUE,
      ]
    ];
  }

}
