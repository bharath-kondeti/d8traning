<?php

namespace Drupal\cms_hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;
use Drupal\cms_hello_world\HelloWorldSalutation;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\TempStore\PrivateTempStoreFactory;
use Drupal\Core\TempStore\SharedTempStoreFactory;

class HelloDrupalWorld extends ControllerBase
{

  /**
   * @var \Drupal\Core\TempStore\PrivateTempStoreFactory $privateFactory
   */
  protected $privateFactory;

  /**
   * @var \Drupal\Core\TempStore\SharedTempStoreFactory $sharedFactory
   */
  protected $sharedFactory;

  /**
   * @var
   * Drupal\cms_hello_world\HelloWorldSalutation
   */
  protected $salutation;

  /**
   * HelloDrupalWorld Constructor
   * 
   * @param HelloWorldSalutation $salutation
   */
  public function __construct(HelloWorldSalutation $salutation)
  {
    $this->salutation = $salutation;
  }

  /**
   * {@inheritDoc}
   */
  public static function create(ContainerInterface $container)
  {
    return new static(
      $container->get('cms_hello_world.salutation')
    );
  }

  /**
   * Simple Hello World function
   *
   * @return mixed
   */
  public function heyHello()
  {
    $privateFactory = \Drupal::service('tempstore.private');
    $store = $privateFactory->get('cms_hello_world.pri_coll');
    $store->set('test_key', 'test_value');

    $sharedFactory = \Drupal::service('tempstore.shared');
    $store = $sharedFactory->get('cms_hello_world.shared_coll');
    $store->set('test_key_shared', 'test_value');

    \Drupal::service('user.data')->set('cms_hello_world', 1, 'user_test_key', 'user_test_value');

    return [
      '#theme' => 'cms_hello_world',
      '#contentpiece' => $this->salutation->getSalutation(),
      '#attached' => [
        'library' => [
          'cms_hello_world/cms_hello_world_library',
        ],
      ],
    ];
  }

  /**
   * Simple Hello World with parameters
   *
   * @param int $id
   * @return mixed
   */
  public function Hello($id)
  {
    return [
      '#type' => 'markup',
      '#markup' => 'Hello Drupal World from cms_hello_world module: ' . $id
    ];
  }

  /**
   * Simple Hello Node with node parameter
   *
   * @param NodeInterface $node
   * @return void
   */
  public function HelloNode(NodeInterface $node)
  {
    var_dump($node);
    die();
  }
}
