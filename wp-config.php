<?php

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'chekscooking');

/** Database username */
define('DB_USER', 'chekscooking');

/** Database password */
define('DB_PASSWORD', 'wR9#x2$Lz!vF');

/** Database hostname */
define('DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

if (!defined('WP_CLI')) {
    // define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    // define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define('WP_HOME', 'http://wordpress.f2i-dev2-vk-gi-nm.fr/');
    define('WP_SITEURL', 'http://wordpress.f2i-dev2-vk-gi-nm.fr/');
}



/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'n5lZsIGhjuKlZfnIrKzWgujrFBP3YXU8X2zfSUgRaMqa1zYpeGckp53lZMzxEdHV');
define('SECURE_AUTH_KEY',  'AIlQ41GGFNoYknivUXn7SuDDUYxdjQPMbNLYocZ8YTHOq9JlXKYJKUPvKjVmKah8');
define('LOGGED_IN_KEY',    'WW8OSPWoBorvSBTsbafixS4IDEaLqgISestKe8w7HnV4C4Q4mReirY26S0xPiCrm');
define('NONCE_KEY',        'j2eQ6i2jzDTEc4J3VMGQk04FwtzTYSgHICn4sZecqdERdKOTIP0k5oV2grM7xMYd');
define('AUTH_SALT',        'JVHWIoXrBxInhIOe7OEMhiEsAqLBYHufBfuS5M9qapVeecFPZEHQAavkS0DatFTH');
define('SECURE_AUTH_SALT', 'mDxx83N413jhLUvNsGvhgynfOlqm0WoRni3jsaovU6PC0ZECQqNHvuT7dTPKcCwz');
define('LOGGED_IN_SALT',   'bjryVzGVJtfLRpC7u1G274Ca35LB4oiQDeNQebOiGVRqAoU9jhMoTZq13eK64Tse');
define('NONCE_SALT',       'JLjj1FVHEJ7QazHX99rEJgtIyW0Y7piwdtEWoVhkPDbZsUblx4buql26vSHSKEJR');
define('WP_ALLOW_REPAIR', true);


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
