<?php

namespace Drupal\cms_hello_world;

class HelloService
{
  /**
   * Home page function
   * @return mixed
   */
  public function home()
  {
    return [
      '#type' => 'markup',
      '#markup' => 'Homepage  - 1'
    ];
  }
}
