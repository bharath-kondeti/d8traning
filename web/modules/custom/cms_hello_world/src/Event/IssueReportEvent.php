<?php

namespace Drupal\cms_hello_world\Event;

use Drupal\Component\EventDispatcher\Event;

class IssueReportEvent extends Event {
  /**
   * Name of the event fired when a new incident is reported.
   *
   * This event allows modules to perform an action whenever a new incident is
   * reported via the incident report form. The event listener method receives a
   * \Drupal\cms_hello_world\Event\IssueReportEvent instance.
   *
   * @Event
   *
   * @see \Drupal\cms_hello_world\Event\IssueReportEvent
   *
   * @var string
   */
  const COMP_REPORT = 'complaint_report';

  /**
   * Issue type
   * 
   * @var string
   */
  protected $type;

  /**
   * Detailed Incident Report
   * 
   * @var string
   */
  protected $message;

  /**
   * Construct the Issue report object
   * 
   * @param string $type
   *   The type of the issue
   * @param string $string
   *   The detailed description of the issue
   */
  public function __construct($type, $message)
  {
    \Drupal::logger("cms_event_test")->notice("Const called");
    $this->type = $type;
    $this->message = $message;
  }

  /**
   * Get type of the issue
   * 
   * @return string
   */
  public function getType() {
    \Drupal::logger("cms_event_test")->notice("Type called");
    return $this->type;
  }

  /**
   * Get description of the issue
   * 
   * @return string
   */
  public function getMessage() {
    return $this->message;
  }

}
