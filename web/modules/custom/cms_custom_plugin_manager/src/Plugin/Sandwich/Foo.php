<?php

namespace Drupal\cms_custom_plugin_manager\Plugin\Sandwich;

use Drupal\cms_custom_plugin_manager\SandwichPluginBase;

/**
 * Plugin implementation of the sandwich.
 *
 * @Sandwich(
 *   id = "foo",
 *   label = @Translation("Foo"),
 *   description = @Translation("Foo description.")
 *   calories = 426
 * )
 */
class Foo extends SandwichPluginBase {
  public function order() {
    return 'The example sandwich plugin for Sandwich Plugin type';
  }
}
