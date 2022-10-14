<?php

namespace Drupal\cms_hello_world;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Config\ConfigFactoryInterface;

class HelloWorldSalutation
{
  use StringTranslationTrait;

  /**
   * @var Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * HelloWorldSalutation Constructor
   * 
   * @param ConfigFactoryInterface $configFactory
   */
  public function __construct(ConfigFactoryInterface $configFactory)
  {
    $this->configFactory = $configFactory;
  }

  public function getSalutation()
  {
    $request_time = \Drupal::time()->getCurrentTime();
    $hours = \Drupal::service('date.formatter')->format($request_time, 'custom', 'H');

    $config = $this->configFactory->get('cms_hello_world.salutation_details');
    $salutation = $config->get('salutation_title');

    // Set login for salutation messages based on hours.
    // Return the same.

    \Drupal::logger("Log_from_here")->notice(print_r($hours, TRUE));

    if ($salutation && $salutation !== "") {
      return "Salutation service is executed";
    }
    return "Service is executed";
  }
}
