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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'headless_blog' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'i,.*<Pg$s 8QJ_S2{Q(ivyC3!ofE4aUtq5#J.;aE#-E,a)-qt#O3<s*MN>byuxQ:' );
define( 'SECURE_AUTH_KEY',  'y^0q~J:mkF#O8T_qN`Lw4*n~Hi%|mIbh@-J]K7s/Aj<uI!p=$u@1bhyvYT K]Bz/' );
define( 'LOGGED_IN_KEY',    'F{0+B`@p$J9Fv#-t}6t0}g<@M9|i v5clj`k+4~`9@3Tj172NN]Hfl@ <tjU@G?F' );
define( 'NONCE_KEY',        '|e}/X>3ky|)b0SEk8> w/)bZAqKVq[P6F~9SChK>ee@>{ze7,,%S6mgw2LdNBM^y' );
define( 'AUTH_SALT',        '{?7H>g<M!Er=Ec)Hf8{,Oaqi%bk&cXe.YDt2RX@Y^/Ynt@Gb9a8F=WTcQi[Su;D$' );
define( 'SECURE_AUTH_SALT', 'Dr3<c:|6;R]g<*)USRvN`T,-$%-GXYAzNN}VE*_>C;M};>wF/;WC#ZcSnX4ou83U' );
define( 'LOGGED_IN_SALT',   '][+$?WN_c`R8Z_GUQ0;!dLDq_`+P[k*C`zJ.[oahxp*l`.m+@n$+kpL`gOOic!w!' );
define( 'NONCE_SALT',       'u{:c5.{Oc{84_z[97iG!YU >4Gbe}>hg~so&9/z*`EDee{m3MgF1rTUa,>}U[A)%' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'bmz_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
