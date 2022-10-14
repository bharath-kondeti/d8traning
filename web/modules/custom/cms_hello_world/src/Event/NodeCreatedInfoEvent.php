<?php

namespace Drupal\cms_hello_world\Event;

use Drupal\Component\EventDispatcher\Event;
use Drupal\node\NodeInterface;

class NodeCreatedInfoEvent extends Event
{
  const EVENT_NAME = 'author_info';

  /**
   * The node object
   * 
   * @var \Drupal\node\NodeInterface
   */
  public $node;

  /**
   * NodeCreatedInfo constructor
   * 
   * @param \Drupal\node\NodeInterface $node
   */
  public function __construct(NodeInterface $node)
  {
    $this->node = $node;
    \Drupal::messenger()->addStatus("Hi @title, This is created @author", [
      'title' => $this->node->getTitle(),
      'author' => $this->node->getOwner()->getDisplayName()
    ]);
  }

  /**
   * Print this message from the method
   */
  public function printThis()
  {
    return 'Printing this message from here';
  }
}
