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
define('DB_NAME', 'crownplaza');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '`{I:]AT^u2ZaBVw`<T|6?*+q WG~Hr-iUTckMR!Yk`D.a{}z+142D<k(8e VL@=x');
define('SECURE_AUTH_KEY',  '|9b]HK3Ir_s#iF=tE@/kDxeS3P%4vQoK|VO2-=sGzrf:W sLIc{hP[QO].DEnw?c');
define('LOGGED_IN_KEY',    'tD3lpfp3ZNM-E~WfWa<-H:2JW=0NWNmBO;&<uSrERH=1945|!`J+CG5v8[Qv-79d');
define('NONCE_KEY',        '-S:0k*(|-#uoC4ofGXlRF1PzycpJzyL3F7ZXg+WtAAa!~Nn~f^Eveb7eX#q|~g:5');
define('AUTH_SALT',        '/Q.bvBKd9.T|/LdHe_-V(PAv)q3#~|SgW:y*Tp(h]sU9WZv`UBS/PLBgDk4|y<-b');
define('SECURE_AUTH_SALT', 'z%)-3HcPILz[[rUri%3-I:!_c,RE@n.ZN|N[M+]-}U4Sdm2_V6vERS>Xbc}=;T(:');
define('LOGGED_IN_SALT',   'A5|Y6;:g-sp$pkAl=XZML8)]ZkV-a43g!_;4?[uM>.|sH%+P8fO2z|2L2qM].4!J');
define('NONCE_SALT',       'x`|WkRn2_Rc9z<=~`uU|8n#YT#<:)^#ce7JK`o=P,jc&e@sN:Ofnj3Wr}q6VUcvA');

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
