<?php

namespace Drupal\cms_hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;
use Drupal\cms_hello_world\HelloWorldSalutation;
use Symfony\Component\DependencyInjection\ContainerInterface;

class HelloDrupalWorld extends ControllerBase
{

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
