<?php

namespace Drupal\cms_hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\cms_custom_plugin_manager\SandwichPluginManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SandwichListings extends ControllerBase {

  /**
   * The sandwich plugin manager.
   *
   * We use this to get all of the sandwich plugins.
   *
   * @var \Drupal\cms_custom_plugin_manager\SandwichPluginManager
   */
  protected $sandwichManager;

  /**
   * Constructor
   * 
   * @param \Drupal\cms_custom_plugin_manager\SandwichPluginManager $sandwichManager
   */
  public function __construct(SandwichPluginManager $sandwichManager)
  {
    $this->sandwichManager = $sandwichManager;
  }

  /**
   * {@inheritDoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('plugin.manager.sandwich')
    );
  }

  /**
   * Callback function for plugin definitions
   */
  public function sandwichList() {
    echo "Call function here";
    //die();
    $sandwich_plugin_definitions = $this->sandwichManager->getDefinitions();
    $items = array();
    foreach ($sandwich_plugin_definitions as $sandwich_plugin_definition) {
      $items[] = t("@id (calories: @calories, description: @description )", [
          '@id' => $sandwich_plugin_definition['id'],
          '@calories' => $sandwich_plugin_definition['calories'],
          '@description' => $sandwich_plugin_definition['description'],
        ]
      );
    }
    print_r($items);
    die();
  }
}