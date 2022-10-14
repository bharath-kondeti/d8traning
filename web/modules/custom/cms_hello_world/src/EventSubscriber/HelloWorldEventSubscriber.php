<?php

namespace Drupal\cms_hello_world\EventSubscriber;

use Drupal\Core\Config\ConfigCrudEvent;
use Drupal\Core\Config\ConfigEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class HelloWorldEventSubscriber implements EventSubscriberInterface
{
  /**
   * {@inheritDoc}
   */
  public static function getSubscribedEvents()
  {
    return [
      ConfigEvents::SAVE => 'configSave',
      ConfigEvents::DELETE => 'configDelete'
    ];
  }

  /**
   * React to config save event
   * 
   * @param \Drupal\Core\Config\ConfigCrudEvent $event
   */
  public function configSave(ConfigCrudEvent $event)
  {
    $config = $event->getConfig();
    \Drupal::messenger()->addStatus('Saved the config: ' . $config->getName());
  }

  /**
   * React to config delete event
   * 
   * @param \Drupal\Core\Config\ConfigCrudEvent $event
   */
  public function configDelete(ConfigCrudEvent $event)
  {
    $config = $event->getConfig();
    \Drupal::messenger()->addStatus('Deleted the config: ' . $config->getName());
  }
}
