<?php
/** 
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'tornadoz_db');

/** MySQL database username */
define('DB_USER', 'tornadoz_db');

/** MySQL database password */
define('DB_PASSWORD', 'bd5wgcm6');

/** MySQL hostname */
define('DB_HOST', 'tornadoz.mysql.ukraine.com.ua:');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'tD%tetiLkPsQmJVbB^yeYKS07a7XCsdrlwnnW8!n3Zw#K#UL#iIdsX!41^#OJrK%');
define('SECURE_AUTH_KEY',  'mYW6youf!wjKLwEca3@qmIM0(iuMMU9KsDk&UeF)yvHX0)UYcBa2Zbrjg1AvpUNu');
define('LOGGED_IN_KEY',    'Vf39rYabbotSuUuYkhSl@ze%1hcBcUWcqs#eftNk6m1#RiEisFcvRSErd%MPVPXG');
define('NONCE_KEY',        'SiuAPJ#pTo1oA#PXs!I)d5GWPfeu)rs17)qMKGTe@iiMnCC6XgjorS^bcC8Xki1D');
define('AUTH_SALT',        '68@Ub&dxO1yVr1zw9()LRrrWgS@Wz2pIfvAVIfkFncxLFXjVl0N9T!z!lVdSnVTB');
define('SECURE_AUTH_SALT', 'L%%(U06Z(w()WWgaPljEVRm07mkgwrIFrEo6bJl7m&JG@47Yc8M9Yp6&!&2Xf2)(');
define('LOGGED_IN_SALT',   '&tWmOfe&zYIawDRiAaJsh*iG1M)OLBc1&xsUuRL(9wR^KYo2fkEKm1Ka5dIx!R(J');
define('NONCE_SALT',       'nuiDQlsKznCDfHtg#)U)F!obRACW0OjKwFua4km&DkM5u2BGgEMeZ1K^%PnByuu)');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each 
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define( 'WP_ALLOW_MULTISITE', true );

define ('FS_METHOD', 'direct');

//--- disable auto upgrade
define( 'AUTOMATIC_UPDATER_DISABLED', true );
?>
