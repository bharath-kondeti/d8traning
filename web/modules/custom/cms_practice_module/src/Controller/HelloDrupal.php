<?php

namespace Drupal\cms_practice_module\Controller;

use Drupal\Core\Controller\ControllerBase;

class HelloDrupal extends ControllerBase
{
  public function helloDrupal()
  {
    return [
      '#theme' => 'hello_drupal',
      '#title' => 'D9 module custom development',
      '#name' => 'Bharath Kumar Kondeti',
      '#designation' => 'Drupal Developer',
      '#current_company' => 'OTIS LDCH Hyderabad'
    ];
  }
}
