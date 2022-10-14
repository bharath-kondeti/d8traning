<?php

namespace Drupal\cms_practice_module;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceProviderBase;
use Drupal\Core\DependencyInjection\ServiceProviderInterface;

class CmsPracticeModuleServiceProvider extends ServiceProviderBase implements ServiceProviderInterface
{
  /**
   * {@inheritDoc}
   */
  public function alter(ContainerBuilder $container)
  {
    $def = $container->getDefinition('cms_hello_world.hello_service');
    $def->setClass('Drupal\cms_practice_module\CmsPracticeModuleHelloService');
  }
}
