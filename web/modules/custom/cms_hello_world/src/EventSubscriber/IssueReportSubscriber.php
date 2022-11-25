<?php

namespace Drupal\cms_hello_world\EventSubscriber;

use Drupal\cms_hello_world\Event\IssueReportEvent;
use Drupal\Core\Messenger\MessengerTrait;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class IssueReportSubscriber implements EventSubscriberInterface {
  use StringTranslationTrait;
  use MessengerTrait;

  /**
   * {@inheritDoc}
   */
  public static function getSubscribedEvents() {
    $events[IssueReportEvent::COMP_REPORT][] = ['notifyMom'];
    $events[IssueReportEvent::COMP_REPORT][] = ['notifyDad'];
    $events[IssueReportEvent::COMP_REPORT][] = ['notifyMe'];

    return $events;
  }

  /**
   * Let mom know about the event
   * 
   * @var \Drupal\cms_hello_world\Event\IssueReportEvent
   */
  public function notifyMom(IssueReportEvent $event) {
    \Drupal::logger('cms_event_testin')->notice($event->getType());
    if ($event->getType() == 'lunch') {
      $this->messenger()->addStatus($this->t('Mom will be alerted'));
    }
  }

  /**
   * Let dad know about the event
   * 
   * @var \Drupal\cms_hello_world\Event\IssueReportEvent
   */
  public function notifyDad(IssueReportEvent $event) {
    \Drupal::logger('cms_event_testin')->notice($event->getType());
    if ($event->getType() == 'money') {
      $this->messenger()->addStatus($this->t('Dad will be alerted'));
    }
  }

  /**
   * Let me know about the event
   * 
   * @var \Drupal\cms_hello_world\Event\IssueReportEvent
   */
  public function notifyMe(IssueReportEvent $event)
  {
    \Drupal::logger('cms_event_testin')->notice($event->getType());
    if ($event->getType() == 'cricket') {
      $this->messenger()->addStatus($this->t('You are alerted'));
    }
  }

}
