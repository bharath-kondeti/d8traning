# D8/D9 TRAINING:
Personal Repo for learning concepts with D8 and D9
## MODULES:
  ### config_ignore:
    - This module is used to hide few config settings from expoting.
    - This can be used if we want settings only for local instance and not move further.
    - Exclude few settings.
    - If we want to ignore config ignore, we have to do from settings.php file:
      - $settings['config_ignore_deactivate'] = TRUE;
  ### ECK:
    - Entity construction kit.
    - This module is used to create entity system like nodes etc.
    - We need to create entity, select the base available fields, add bundles and then create fields based on requirements.
  ### EVA:
    - Entity View Attachment
    - EVA provides a Views display plugin that allows the output of a View to be attached to the content of any Drupal entity.
    - EVA will be created as view attachment and will be added to manage display tab for the content type.
    - This plugin provides filter getting nodes from other content type based on some argument passed from some another content type.
# DRUPAL DATA STORAGE:
  ### STATE API:
    - The State API is a key/value database storage.
    - This is simplest way to store data in Drupal.
    - The basic implementation of state API is to store the state of the system. This is for developers purpose. Can be set, edit and deleted by the code which developers write.
    - Last cron run time, flag to keep to check on tasks that needs to be executed could be the best examples for state API.
    - State variables cannot be exported or imported by config management.
    - \Drupal\Core\State\StateInterface provides all the methods related to all state APIs.
    - The classes can either inject that service or use it statically using \Drupal::state()
    - \Drupal::state()->set('var', 'value');
    - \Drupal::state()->setMultiple(['var1' => 'value1', 'var2' => 'value2']);
    - \Drupal::state()->get('var');
    - \Drupal::state()->getMultiple(['var1', 'var2']);
    - \Drupal::state()->delete('var');
    - \Drupal::state()->deleteMultiple(['var1', 'var2']);
    - These values are stored in key_value table under namespace of system.
  ### TempStore:
    - This is also a key/value pair data, but for keeping temporary data. Similar to sessions.
    - Can be used in multi-step forms and work in progress items.
    - These are two types: Private and Shared
    - Private TempStore belongs to that particular user.
    - Shared TempStore can be shared among users.
    - A TempStore can have an expiration date, after which it will be automatically be cleared.
    - PrivateTempStore, PrivateTempStoreFactory are key players that provide methods for private tempstore functionality.
    - SharedTempStore, SharedTempStoreFactory are key players that provide methods for shared tempstore functionality.
    - These values are saved in key_value_expire table.
    - Collection in the table for private: user.private.collection_name and Collection in the table for shared: user.shared.collection_name.
    - The default expiry time for tempstore value are 604800 seconds ~ 7 days ~ 1 week.
    - /** @var \Drupal\Core\TempStore\PrivateTempStoreFactory
       */
      $factory;
      $factory = \Drupal::service('tempstore.private');
      $store = $factory->get('my_module.my_collection');
      $store->set('my_key', 'my_value');
      $value = $store->get('my_key');
    - /** @var \Drupal\Core\TempStore\SharedTempStoreFactory 
      */
      $factory;
      $factory = \Drupal::service('tempstore.shared');
      $store = $factory->get('my_module.my_collection');
      $store->set('my_key', 'my_value');
      $value = $store->get('my_key');
    - $store->setIfNotExists('my_key', 'my_value'); 
    - $store->setIfOwner('my_key', 'my_value');
    - $store->deleteIfOwner('my_key');
  ### UserData API:
    - User-specific storage option provided by user module.
    - This is different from the user level content fields which we provide to save user data.
    - This is more like state API.
    - \Drupal\user\UserDataInteface and UserDataService provide methods for the functionality
    - \Drupal::service('user.data')->get($moduleName, $uid, $name);
    - \Drupal::service('user.data')->set($moduleName, $uid, $name, $value);
    - \Drupal::service('user.data')->delete($moduleName, $uid, $name);
    - The data is stored in users_data table
  ### Configuration API:
    - Configuration is a collection of various settings that shows how the site is functioning, apart from content.
    - Configuration in Drupal used to storing those settings that needs to moved and enabled across different environments.
    - Drupal saves the configuration in the database, but it also makes them as exportable YMLs
    - Configs will exported, moved via git to nex env and imported there, simple funda.
    - Two type of configurations:
      - Simple Config Entity: Like module config data.
      - Complex Config entity: Like views
    - Config Entity: For custom modules, we can move module specfic configs in config/install folder, which will be imported while module installation
    - Config Schema: This defines how diff systems interact with config entities. These can be defined config/schema folder in the custom module.
    - Continue Here:
  ### Entities:
    - Entities are instances of different entity types. We can have more than one entities in the system
    - Content Entity vs Config Entity
    - Config Entity:
      - Instance of type configuration like views, image style, roles
    - Content Entity:
      - With these, we can design the data model for adding content.
      - These are not exportable.
      - These are content pieces that can be used in core business logic of any functionality.
      - Node, Comment, User, Taxonomy are some examples for content entity type.
    - Entity Type Plugins:
      - Drupal entity types are plugins
      - Drupal\Core\Entity\Annotation\EntityType is the Base annotation class.
      - ContentEntityType and ConfigEntityType annotations extends the above base class.
      - From EntityType Annotation class maps plugin class Drupal\Core\Entity\EntityType plugin.
      - From Drupal\Core\Entity\EntityType plugin class ContentEntityType and ConfigEntityType plugin classes are mapped.
      - Check Node.php and NodeType.php for example plugin annotation settings for both ContentEntityType and ConfigEntityType
      - EntityTypeManager is plugin manager that is used as plugin manager for these classes.
    - Interacting with Entity API:
      - Nothing but how do we query the database
      - Quering Entities:
        - $query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();
      - Building Queries:
        - $query
            ->condition('type', 'article')
            ->condition('status', TRUE)
            ->range(0, 10)
            ->sort('created', 'DESC');
        - $ids = $query->execute();
        - Complex conditions:
          - Check \Drupal\Core\Entity\Query\QueryInterface condition() method for more information.
          - ->condition('type', ['article', 'page'], 'IN') 
          - $query->condition('status', TRUE);
          - $or = $query->orConditionGroup()
              ->condition('title', 'Drupal', 'CONTAINS')
              ->condition('field_tags.entity.name', 'Drupal', 'CONTAINS');
          - $query->condition($or);
          - $ids = $query->execute();
          - Group OR conditions
          - We can also ->accessCheck(FALSE) to the query to bypass the access checks for users
        - The entity query system works for config entities as well.
          - $query = \Drupal::entityTypeManager()->getStorage('view')->getQuery();
          - $query->condition('display.*.display_plugin', 'page');
          - $ids = $query->execute();
          - This will search all view config entities with display_plugin page
      - Loading Entites:
        - We will have entity IDs from our query we execute above.
        - For loading entities, we have to entityManager again:
          - \Drupal::entityTypeManager()->getStorage('node')->loadMultiple($ids);
          - \Drupal::entityTypeManager()->getStorage('node')->load($id);
          - The above will return NodeInterface objects.
        - For config entities:
          - \Drupal::entityTypeManager()->getStorage('node_type')->load('article');
      - Reading Entities:
        - For config entities:
          - $type = \Drupal::entityTypeManager()->getStorage('node_type')->load('article');
          - $type->id(); //machine name of article - article 
          - $type->label(); //Label of the content type - Article
          - $type->uuid(); // UUID of the content type - some_uuid
          - $type->bundle(); // Bundle of the content type - node_type
        - For content entities:
          - $node = Node::load(1); // Add class Drupal\Core\Node\NodeInterface\Node
          - $node->getTitle() or $node->get('title');
          - use Drupal\node\Entity\Node;
          - $node = Node::load(811);
          - echo $node->getTitle();
          - echo $node->get('title')->value;
          - echo $node->title->value;
          - echo $node->title->getValue()[0]['value'];
          - Similarly for remaining fields
      - Manipulating Entities:
        - Custom way to changing entity values and saving them.
        - From the above:
          - $node->set('title', 'new title');
          - $node->save();
          - $node->get('title')->setValue('new title');
          - $node->save();
        - For config entities:
          - $type = \Drupal::entityTypeManager()->getStorage('node_type')->load('article');
          - $type->set('name', 'News');
          - $type->save();
      - Creating Entities:
        - Creating new entities programatically:
        - $values = [
            'type' => 'article',
            'title' => 'My title'
          ];
        - /** @var \Drupal\node\NodeInterface $node */
        - $node = \Drupal::entityTypeManager()->getStorage('node')->create($values);
        - $node->set('field_custom', 'some text');
        - $node->save();
      - Rendering Config entities:
        - To be continued
  ### The SCHEMA API:
    - The main purpose of schema API is to create DB definitions in PHP, interact with Drupal with those definitions and convert them into tables.
    - The central component of the SCHEMA API is hook_schema. This will be defined in .install file of custom module and this file is triggered only once during the module install.
    - If we need to update any existing table, we will work through post update hooks.
    - We can also use hook_query_alter or hook_query_tag_alter by adding a tag to the sql query we are writing and alter the query from custom module.
    - hook_update_N
      - If we want to use to update the schema once the module is installed, we must use hook_update_N and run with update.php or drush updb command.
  ### DRUPAL ACCESS SYSTEM:
    - Roles, Permissions, Accesses
    - Route Access:
      - While defining routes, we can give route permission in requirements > _permission key. We can give permission names, where we give permission names.
      - We also have _role, where we can give role names as permission check for routes
      - Custom Route Access:
        - The _permission and _role route access check if defined by core and very flexible, but its hard-coded. 
        - If we need to have dynamic route access checks, we must use _custom_access key where we can define a class with some code where we can handle access to the routes.
        - There are two approaches; static approach and service approach. Static is we define the class and call it in _custom_access directly. Service approach, we create the class and reference it.
        - Static:
          - This approach generally involves with creating access method in your controller or Form
          - In that access methods, we use AccessResultInterface and its required classes to declare the access checks.
## DRUSH:
  - drush cr: Cache clear
  - drush en module_name: For enabling module
  - drush then theme_name: For enabling theme
  - drush ucrt
    - For creating users
	  - drush user:create name --mail="mail" --password="password"
	  - drush user:create testuser2 --mail="test2@testing.com" --password="admin123"
  - drush rcrt
    - For creating roles
    - Accepts 2 arguments (machine_name and human readable name)
    - drush role:create
    - drush rcrt machine_name role_name
  - drush urol
    - drush user-role-add
    - For adding role to exisiting user.
    - drush urol role_machine_name user_name
  - drush state:set system.maintenance_mode 1
    - drush sset system.maintenance_mode 1
    - For putting site in maintenance mode
  - drush config-set system.theme default <theme_name>
    - Set default theme for the site
    - drush config-set system.theme admin <theme_name>
    - Set admin theme for the site
  - drush ev "\Drupal::keyValue('system.schema')->set('module_name', (int) 9000)"
    - For force setting the hook updb number.