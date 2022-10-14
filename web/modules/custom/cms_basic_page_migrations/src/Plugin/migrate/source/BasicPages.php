<?php

namespace Drupal\cms_basic_page_migrations\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Source Plugin for Basic pages.
 *
 * @MigrateSource(
 *  id = "basic_pages",
 *  source_module = "cms_basic_page_migrations"
 * )
 */

class BasicPages extends SqlBase
{
  /**
   * {@inheritdoc}
   */
  public function query()
  {
    $query = $this->select('node', 'n')
      ->condition('n.type', 'page')
      ->fields(
        'n',
        [
          'nid',
          'type',
          'title',
          'uid',
          'status',
          'created',
          'changed',
          'promote',
          'sticky',
        ]
      );
    $query->orderBy('nid');

    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields()
  {
    return $this->baseFields();
  }

  /**
   * Returns the user base fields to be migrated.
   *
   * @return array
   *   Associative array having field name as key and description as value.
   */
  protected function baseFields()
  {
    $fields = [
      'nid' => $this->t('Node ID'),
      'type' => $this->t('Type'),
      'title' => $this->t('Title'),
      'uid' => $this->t('Node author UID'),
      'status' => $this->t('Published or not'),
      'created' => $this->t('Created timestamp'),
      'changed' => $this->t('Modified timestamp'),
      'promote' => $this->t('Promoted to front page'),
      'sticky' => $this->t('Sticky at top of lists'),
    ];

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds()
  {
    return [
      'nid' => [
        'type' => 'integer',
        'alias' => 'n',
      ],
    ];
  }
}
