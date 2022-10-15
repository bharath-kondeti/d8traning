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