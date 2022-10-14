<?php

namespace Drupal\cms_hello_world\EventSubscriber;

use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class HelloWorldRedirectSubscriber implements EventSubscriberInterface
{

  /**
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $account;

  /**
   * @var \Drupal\Core\Routing\RouteMatchInterface
   */
  protected $route_match;

  /**
   * HelloWorldRedirectSubscriber Constructor
   */
  public function __construct(AccountProxyInterface $account)
  {
    $this->account = $account;
  }

  /**
   * {@inheritDoc}
   */
  public static function getSubscribedEvents()
  {
    $events[KernelEvents::REQUEST][] = ['onRequest', 0];
    return $events;
  }

  /**
   * Handler for kernel request 
   * 
   * @param Symfony\Component\HttpKernel\Event\FilterResponseEvent $event
   */
  public function onRequest(RequestEvent $event)
  {
    $roles = $this->account->getRoles();
    $route_name = 'cms_hello_world.hello_world';

    //\Drupal::logger('cms_hello_world')->notice(print_r($roles, TRUE));

    if ($route_name !== 'cms_hello_world.hello_world') {
      return;
    }

    // if (in_array('administrator', $roles)) {
    //   $event->setResponse(new RedirectResponse('/'));
    // }
  }
}
