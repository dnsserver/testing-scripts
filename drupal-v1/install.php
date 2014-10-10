<?php

/**
 * @file
 * Initiates a browser-based installation of Drupal.
 */

/**
 * Defines the root directory of the Drupal installation.
 */
define('DRUPAL_ROOT', getcwd());

/**
 * Global flag to indicate the site is in installation mode.
 */
define('MAINTENANCE_MODE', 'install');

// Exit early if running an incompatible PHP version to avoid fatal errors.
if (version_compare(PHP_VERSION, '5.2.4') < 0) {
  print 'Your PHP installation is too old. Drupal requires at least PHP 5.2.4. See the <a href="http://drupal.org/requirements">system requirements</a> page for more information.';
  exit;
}

// Start the installer.
require_once DRUPAL_ROOT . '/includes/install.core.inc';

require_once DRUPAL_ROOT . '/opsworks.php';

$opsWorks = new OpsWorks();

$settings = array(
    'parameters' => array(
      'profile' => 'standard',
      'locale' => 'en',
    ),
    'forms' => array(
        'install_settings_form' => array(
            'driver' => 'mysql',
            'mysql' => array(
                'database' => $opsWorks->db->database,
                'username' => $opsWorks->db->username,
                'password' => $opsWorks->db->password,
                'host' => $opsWorks->db->host,
                'port' => '3306',
                'db_prefix' => '',
                ),
        ),
        'install_configure_form' => array(
            'site_name' => 'My Site',
            'site_mail' => 'foo@foo.com',
            'account' => array(
                'name' => 'admin',
                'mail' => 'foo@foo.com',
                'pass' => array(
                    'pass1' => 'foobar',
                    'pass2' => 'foobar',
                ),
            ),
            'site_default_country' => 'US',
            'date_default_timezone' => 'America/New_York',
            'update_status_module' => array(
                1 => TRUE,
                2 => TRUE,
            ),
            'clean_url' => FALSE,
        ),
    ),
);

install_drupal($settings);
