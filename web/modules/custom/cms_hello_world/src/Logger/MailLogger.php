<?php

namespace Drupal\cms_hello_world\Logger;

use Drupal\Component\Render\FormattableMarkup;
use Drupal\Core\Logger\RfcLoggerTrait;
use Drupal\Core\Logger\RfcLogLevel;
use Psr\Log\LoggerInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Logger\LogMessageParserInterface;
use Psr\Container\ContainerInterface;

class MailLogger implements LoggerInterface
{
  use RfcLoggerTrait;

  /**
   * @var \Drupal\Core\Logger\LogMessageParserInterface
   */
  protected $parser;

  /**
   * @var \Drupal\Core\Config\ConfigFactoryInterface;
   */
  protected $configFactory;

  /**
   * MailLogger constructor
   * @param \Drupal\Core\Config\ConfigFactoryInterface $configFactory
   * @param \Drupal\Core\Logger\LogMessageParserInterface $parser
   */
  public function __construct(ConfigFactoryInterface $configFactory, LogMessageParserInterface $parser)
  {
    $this->configFactory = $configFactory;
    $this->parser = $parser;
  }

  /**
   * {@inheritDoc}
   */
  public function log($level, $message, array $context = [])
  {
    if ($level !== RfcLogLevel::ERROR) {
      return;
    }

    \Drupal::logger('cms_hello_world')->notice('Testing the Mail logger here');

    // Send Email for errors.
    // $to = 'bharathkumarkondeti@gmail.com';
    // $langcode = $this->configFactory->get('system.site')->get('langcode');
    // $variables = $this->parser->parseMessagePlaceholders($message, $context);
    // $markup = new FormattableMarkup($message, $variables);
    // \Drupal::service('plugin.manager.mail')
    //   ->mail('cms_hello_world', 'cms_hello_world_log', $to, $langcode, ['message' => $markup]);
  }
}
