<?php

/**
 * Defines Singleton functionality in a trait.
 */
trait DateSingletonTrait {

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

}
