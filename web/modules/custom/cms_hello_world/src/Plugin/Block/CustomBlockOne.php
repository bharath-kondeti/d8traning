<?php

namespace Drupal\cms_hello_world\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;

/**
 * Custom Block One
 * 
 * @Block(
 *   id="custom_block_one",
 *   admin_label=@Translation("Custom Block One")
 * )
 */
class CustomBlockOne extends BlockBase {
  /**
   * {@inheritDoc}
   */
  public function build()
  {
    return[
      '#markup' => 'Custom block from new plugin.'
    ];
  }

  /**
   * {@inheritDoc}
   */
  public function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, "cms hello world block access");
  }
}
