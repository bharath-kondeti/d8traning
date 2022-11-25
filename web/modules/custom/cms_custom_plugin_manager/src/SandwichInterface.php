<?php

namespace Drupal\cms_custom_plugin_manager;

/**
 * An interface for all Sandwich type plugins.
 */
interface SandwichInterface
{

  /**
   * Provide a description of the sandwich.
   *
   * @return string
   *   A string description of the sandwich.
   */
  public function description();

  /**
   * Provide the number of calories per serving for the sandwich.
   *
   * @return float
   *   The number of calories per serving.
   */
  public function calories();

  /**
   * @param array $extras
   *   An array of extra ingredients to include with this sandwich.
   *
   * @return mixed
   */
  public function order();
}
