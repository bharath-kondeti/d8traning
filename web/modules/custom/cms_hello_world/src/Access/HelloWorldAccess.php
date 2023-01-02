<?php

namespace Drupal\cms_hello_world\Access;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Routing\Access\AccessInterface;
use Drupal\Core\Session\AccountInterface;

class HelloWorldAccess implements AccessInterface {

  /**
   * Helper function for custom access checking
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   * @return AccessReult
   */
  public function access(AccountInterface $account) {
    return in_array('administrator', $account->getRoles()) ? AccessResult::allowed() : AccessResult::forbidden();
  }
}
