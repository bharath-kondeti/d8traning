<?php

namespace Drupal\cms_hello_world\Plugin\Derivative;

use Drupal\Component\Plugin\Derivative\DeriverBase;

/**
 * Provides block plugin definitions for sample blocks.
 *
 * @see \Drupal\cms_hello_world\Plugin\Block\HelloPractice
 */
class HelloPractice extends DeriverBase {
  /**
   * {@inheritDoc}
   */
  public function getDerivativeDefinitions($base_plugin_definition)
  {
    $blocks = [];
    $this->derivatives = [];
    $blocks = [
      'hello_practice_first' => 'Hello Practice First',
      'hello_practice_second' => 'Hello Practice Second',
    ];
    foreach($blocks as $block_id => $block_label) {
      $this->derivatives[$block_id] = $base_plugin_definition;
      $this->derivatives[$block_id]['admin_label'] = t($block_label);
    }

    \Drupal::logger('cms_test')->notice(print_r($this->derivatives, TRUE));

    return $this->derivatives;
  }
}
