<?php

namespace Drupal\cms_hello_world\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Logger\LoggerChannelInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Psr\Log\LoggerInterface;

class SalutationForm extends ConfigFormBase
{

  /**
   * @var \Drupal\Core\Logger\LoggerChannelInterface
   */
  protected $logger;

  /**
   * Salution form constructor
   * 
   * @param \Drupal\Core\Logger\LoggerChannelInterface $logger
   */
  public function __construct(LoggerChannelInterface $logger)
  {
    $this->logger = $logger;
  }

  /**
   * {@inheritDoc}
   */
  public static function create(ContainerInterface $container)
  {
    return new static(
      $container->get('cms_hello_world.logger.channel.cms_hello_world'),
    );
  }

  /**
   * {@inheritDoc}
   */
  public function getEditableConfigNames()
  {
    return ['cms_hello_world.salutation_details'];
  }

  /**
   * {@inheritDoc}
   */
  public function getFormId()
  {
    return 'salutation_config_form';
  }

  /**
   * {@inheritDoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $config = $this->config('cms_hello_world.salutation_details');

    $form['salutation_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Salution Message'),
      '#description' => $this->t('Please provide the salutation you want to use.'),
      '#default_value' => $config->get('salutation_title'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritDoc} 
   */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    $salutationMessage = $form_state->getValue('salutation_title');

    if (is_numeric($salutationMessage)) {
      $form_state->setErrorByName('salutation_message', $this->t('Numbers are not allowed'));
    }
  }

  /**
   * {@inheritDoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $this->config('cms_hello_world.salutation_details')
      ->set('salutation_title', $form_state->getValue('salutation_title'))
      ->save();

    $this->logger->info('Logging messaged logged using new logging channel');

    parent::submitForm($form, $form_state);
  }
}
