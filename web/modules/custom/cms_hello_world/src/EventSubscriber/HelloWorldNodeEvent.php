<?php

namespace Drupal\cms_hello_world\EventSubscriber;

use Drupal\cms_hello_world\Event\NodeCreatedInfoEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class HelloWorldNodeEvent implements EventSubscriberInterface
{
  /**
   * {@inheritDoc}
   */
  public static function getSubscribedEvents()
  {
    return [
      NodeCreatedInfoEvent::EVENT_NAME => 'onNodeSave',
    ];
  }

  /**
   * Helper function for on Node Save event
   * 
   * @param Drupal\cms_hello_world\Event\NodeCreatedInfoEvent $node
   */
  public function onNodeSave(NodeCreatedInfoEvent $node)
  {
    \Drupal::messenger()->addStatus('Custom Event Triggered' . $node->printThis());
  }
}
