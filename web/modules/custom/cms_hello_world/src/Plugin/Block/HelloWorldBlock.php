<?php

namespace Drupal\cms_hello_world\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\cms_hello_world\HelloWorldSalutation;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Hello World Block
 * 
 * @Block(
 *   id="hello_world_block",
 *   admin_label=@Translation("Hello World Block")
 * )
 */
class HelloWorldBlock extends BlockBase implements ContainerFactoryPluginInterface
{
  /**
   * @var Drupal\cms_hello_world\HelloWorldSalutation
   */
  protected $salutation;

  /**
   * HelloWorldBlock Constructor
   *
   * @param array $configuration
   * @param $plugin_id
   * @param $plugin_definition
   * @param HelloWorldSalutation $salutation
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, HelloWorldSalutation $salutation)
  {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->salutation = $salutation;
  }

  /**
   * {@inheritDoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition)
  {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('cms_hello_world.salutation')
    );
  }

  /**
   * {@inheritDoc}
   */
  public function defaultConfiguration()
  {
    return [
      'enabled' => 1,
    ];
  }

  /**
   * {@inheritDoc}
   */
  public function blockForm($form, FormStateInterface $form_state)
  {
    $config = $this->getConfiguration();

    $form['enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('enabled'),
      '#description' => $this->t('Enable this feature'),
      '#default_value' => $config['enabled'],
    ];
  }

  /**
   * {@inheritDoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state)
  {
    $this->configuration['enabled'] = $form_state->getValue('enabled');
  }

  /**
   * {@inheritDoc}
   */
  public function build()
  {
    return [
      '#type' => 'markup',
      '#markup' => 'Custom Block is here'
    ];
  }
}
