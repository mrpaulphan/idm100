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
define('DB_NAME', 'wp_idm100');

/** MySQL database username */
define('DB_USER', 'wp_idm100');

/** MySQL database password */
define('DB_PASSWORD', 'wp_idm100');

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
define('AUTH_KEY',         'QD]31~(t.-(mk(IU|k}yd+]E{k(odo<)ur~89r5*Ckb/)AD(1`4jSygn-R8.<4?H');
define('SECURE_AUTH_KEY',  'w|aXJU>]9g}{I{hos1T~5sxwd81[X^Df6q<!Vy_@sIzo[[z/Jw)ZYIST;<MMT2Lq');
define('LOGGED_IN_KEY',    'Gk6Qq2`CH/]1-v)()=9rIU)HGD&$8eYXDsglt.zNsCd<>HFI[@m%0sD8X9T:WW`j');
define('NONCE_KEY',        '(9.ZM(sUm)Y;HjZz3ieG[A82]?Opi/fOB<$H{hykM-08hG^e7Y&0h(LXy@]HBkQ^');
define('AUTH_SALT',        'vaJ3{>%szUVy55ZHp;0{x~UO ?{A+Z.`FZPXrzYsnauDc-%eM]N^>v;PdoB@[V2I');
define('SECURE_AUTH_SALT', '|n S)KM(c&:$`ctJ/9x?zb%!MjuV]Hz]0.@M2&>LjWZ9_1XIM74lPTG2||zFVCqQ');
define('LOGGED_IN_SALT',   '.u[J(hj*<wy(v.J56:s4oy}jUs?{lJ`p`(t&d>xu/Me&,]Nz*J/jhN>LM!l$a90{');
define('NONCE_SALT',       'TX]^#zqj2t]G]H_+Cto4&jrx@~UBDQUK[4A.r0wi=k|&IR>O_t4SoR?LOW}%[jW?');

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
