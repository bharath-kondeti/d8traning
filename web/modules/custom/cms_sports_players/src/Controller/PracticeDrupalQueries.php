<?php

namespace Drupal\cms_sports_players\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class for SCHEMA API practice
 */
class PracticeDrupalQueries extends ControllerBase {
  /**
   * Function that includes all queries for practicing SCHEMA API
   */
  public function PracticeQueries() {
    $database = \Drupal::database();

    echo "Insert Teams<br>";
    // Insert into teams table.
    /*$teams = [
      [
        'name' => 'Cheetahs',
        'description' => 'Cheetahs team belong to OPL cricket tournament.'
      ],
      [
        'name' => 'Tigers',
        'description' => 'Tigers team belong to OPL cricket tournament.'
      ],
      [
        'name' => 'Unicorns',
        'description' => 'Unicorns team belong to OPL cricket tournament.'
      ],
      [
        'name' => 'Panthers',
        'description' => 'Panthers team belong to OPL cricket tournament.'
      ],
    ];
    $fields = ['name', 'description'];
    $query = $database->insert('teams')->fields($fields);
    foreach($teams as $team) {
      $query->values($team);
    }
    $query->execute();
    echo "Here Players insert";*/

    echo "Insert Players<br>";
    //Insert into players table
    /*$players = [
      [
        'name' => 'P6',
        'team_id' => 1,
        'data' => serialize(['style' => 'RHB', 'position' => '3']),
      ],
      [
        'name' => 'P7',
        'team_id' => 2,
        'data' => serialize(['style' => 'LHB', 'position' => '2']),
      ],
      [
        'name' => 'P8',
        'team_id' => 3,
        'data' => serialize(['style' => 'RHB', 'position' => '5']),
      ],
      [
        'name' => 'P10',
        'team_id' => 4,
        'data' => serialize(['style' => 'RHB', 'position' => '6']),
      ],
      [
        'name' => 'P9',
        'team_id' => 5,
        'data' => serialize(['style' => 'LHB', 'position' => '4']),
      ],
    ];
    $fields = ['name', 'team_id', 'data'];
    $query = $database->insert('players')->fields($fields);
    foreach($players as $player) {
      $query->values($player);
    }
    $query->execute();
    echo "Here Players insert";*/

    // Select queries
    echo "Select one<br>";
    /*$result = $database->query("SELECT * FROM {teams}");
    echo "<pre>";
    print_r($result->fetchAll());*/

    echo "Select two<br>";
    //Join queries
    /*$result = $database->query("SELECT * FROM {players} p JOIN {teams} t ON t.[id] = p.[id] WHERE t.[id] = :id", [':id' => 1]);
    print_r($result->fetchAll());*/

    echo "Select three<br>";
    /*$query = $database->select('players', 'p');
    $query->join('teams', 't', 'p.id = t.id');
    $query->addField('p', 'name', 'player_name');
    $query->addField('t', 'name', 'team_name');
    $query->addField('t', 'description', 'team_description');
    $query->addField('p', 'data', 'player_data');
    $result = $query->fields('p', ['id', 'data'])
      ->condition('p.id', 1)
      ->execute();    
    print_r($result->fetchAll());*/

    //Update records
    /*$query = $database->update('players')
      ->fields(['data' => serialize(['style' => 'RHB', 'position' => '8']), 'name' => 'P11'])
      ->condition('id', 2);
    $query->execute();*/

    echo "Query Alter<br>";
    /*$query = $database->select('players', 'p')->fields('p')->addTag('player_q');
    $result = $query->execute();
    print_r($result->fetchAll());*/

    echo "Query Alter two<br>";
    /*$query = $database->select('players', 'p')->fields('p')->addTag('player_qq');
    $result = $query->execute();
    print_r($result->fetchAll());*/

    //Delete records
    echo "Delete Records<br>";
    $query = $database->delete('players')->condition('id', 10);
    $query->execute();

    die();
  }
}
