<?php

namespace Drupal\cms_practice_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a simple Hello World block
 * 
 * @Block(
 *  id = "hello_world",
 *  admin_label = @Translation("Hello World Block")  
 * )
 */
class HelloWorld extends BlockBase
{
  /**
   * {@inheritDoc}
   */
  public function build()
  {
    return [
      '#type' => 'markup',
      '#markup' => 'Hello World Block is here',
    ];
  }
}
