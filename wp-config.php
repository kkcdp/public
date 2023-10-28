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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',          'Igk*y-H`Z;Q<l.lpVN0b*-_YCWr|,a6IIBT[fV<{.r=Y}_(Wmjn$e>e0Dq_dD2?b' );
define( 'SECURE_AUTH_KEY',   'uk0U`IK,s5YI~&mK}Uz:A9^Nl8HbfGyu6ZZE[ks)i[YzuOn3Com4~bFI>)v{PK3Y' );
define( 'LOGGED_IN_KEY',     'G*mI>p5r^U;5qlF78C{.[o/B7(ab7]+BYzaXr`sZ-:?:jNMB+JbUP[_T0}QpUD>r' );
define( 'NONCE_KEY',         '/)*)(lP{48he.Yz/G>xN0yt$~EX9A9gI+Ry7$3Y0RW]#%y0m8ZSxI%=ej{dtUew:' );
define( 'AUTH_SALT',         '5M|~yfjvOJtF7Jn][Y_F@e:s^+<&$sL_1d;nBQ`{@=z4DP16`M|/U]-YiiI[PMwm' );
define( 'SECURE_AUTH_SALT',  'uVfLSQaz1#A4mp=N1a:@&n g0fy5LjU=o7HrxpbKWMq<&1at-U~20Mo@NuauG>jS' );
define( 'LOGGED_IN_SALT',    '8sngN0GeR((xk< sV]xqHtS^zH_W;rrLQf9#BTdz@Gbx%!3X6B 0=z7.Zn?x/e$#' );
define( 'NONCE_SALT',        'ZLevIh} d9e%NL_7nZ>;Ok%~HnS>sg,43ELDjge4Wxpmo*I;RW2juw~1z%D9Yk6P' );
define( 'WP_CACHE_KEY_SALT', 'gMI d$:|XA?#8!vCaYN3KA?&[3I*y(z<78,+f5F):MYf|UgHvc_>:G9Gyj9fI,x(' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define('WP_DISABLE_FATAL_ERROR_HANDLER', true);

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
