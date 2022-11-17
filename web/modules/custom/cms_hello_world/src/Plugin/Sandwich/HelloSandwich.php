<?php

namespace Drupal\cms_hello_world\Plugin\Sandwich;

use Drupal\cms_custom_plugin_manager\SandwichPluginBase;

/**
 * Plugin implementation of sadwich
 * 
 * @Sandwich(
 *   id = "hellosandwich"
 *   label = @Translate("Hello Sandwich")
 *   description = @Translate("Hello Sandwich Plugin.")
 *   calories = 444
 * )
 */
class HelloSandwich extends SandwichPluginBase {
  public function order() {
    return "Okay Tsting here";
  }
}
