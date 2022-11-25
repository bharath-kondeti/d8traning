<?php

namespace Drupal\cms_hello_world\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Hello Practice Block
 * 
 * @Block(
 *   id = "hello_practice",
 *   admin_label = @Translation("Hello Practice Block"),
 *   deriver = "Drupal\cms_hello_world\Plugin\Derivative\HelloPractice"
 * )
 */
class HelloPractice extends BlockBase {
  /**
   * {@inheritDoc}
   */
  public function build() {
    $block_id = $this->getDerivativeId();
    return [
      '#markup' => 'Hello Practice Markup: ' . $block_id
    ];
  }
}
