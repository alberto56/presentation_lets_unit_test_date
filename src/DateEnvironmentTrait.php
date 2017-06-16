<?php

/**
 * Defines environment function wrappers for testability.
 */
trait DateEnvironmentTrait {

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
