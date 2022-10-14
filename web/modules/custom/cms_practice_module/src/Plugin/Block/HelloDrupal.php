<?php

namespace Drupal\cms_practice_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a simple Hello Drupal block
 * 
 * @Block(
 *  id = "hello_drupal",
 *  admin_label = @Translation("Hello Drupal Block")  
 * )
 */
class HelloDrupal extends BlockBase
{
  /**
   * {@inheritDoc}
   */
  public function build()
  {
    return [
      '#type' => 'markup',
      '#markup' => 'Hello Drupal Block is here',
      '#attributes' => [
        'class' => ['new-block-class-1', 'new-block-class-2'],
      ],
    ];
  }
}
