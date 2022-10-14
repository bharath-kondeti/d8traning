<?php

namespace Drupal\cms_practice_module;

class CmsPracticeModuleHelloService
{
  /**
   * Home page function
   * @return mixed
   */
  public function home()
  {
    return [
      '#type' => 'markup',
      '#markup' => 'Homepage - 2'
    ];
  }
}
