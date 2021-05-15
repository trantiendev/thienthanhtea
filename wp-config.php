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
define( 'DB_NAME', "thienthanhtea_host" );

/** MySQL database username */
define( 'DB_USER', "root" );

/** MySQL database password */
define( 'DB_PASSWORD', "" );

/** MySQL hostname */
define( 'DB_HOST', "localhost" );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '7KTeIjj>sl~%d44v)5nd5ePq}u-K$LEap-wu*Z.,_yFKP#m=Lfk0RPHp+`JR#,dY' );
define( 'SECURE_AUTH_KEY',  'Q+F^wo;B7PTGf$m3h>@>pv+PL#lq`PQ;|[^TSzU2~6Vf>~;3O6:u:$_@=b1Y-/%c' );
define( 'LOGGED_IN_KEY',    '?JQ.AhV(g>[&M,vc&-GM7IOFG{W1I{v[)l<`)~>WgC$~#Vr23yz7@MgVPkQRbRZj' );
define( 'NONCE_KEY',        '~k~Hp`4D!b]8$2pF:zFPG)}5a?, nQEIy99_(HiGxqaVl$47?w{EAr{q`eSW]?]G' );
define( 'AUTH_SALT',        'MU{Z,HAOdo>[Lr{:C8x|$ #6lj*K!yrpsJ/G+,#4DMyqVzY:B9x-D}&FZj>`9+m9' );
define( 'SECURE_AUTH_SALT', 'n)#Y*!w5?}Z%6ATW!s>d<^e)#f3{|Jq0&8@,#!g?}@if7M80&0>`.WQ~:|RnN@Y>' );
define( 'LOGGED_IN_SALT',   '_xiyje}6Wl:(k}m}8ZD2S(Q !e NT;;2Zy(eN{=7A*pgH%{pMK2(]zyGYeaBdstf' );
define( 'NONCE_SALT',       '}+M7!0G0y]Hhpjqq10~|{$H>T;y}:=e7ts}rHMc0Oow5=1y7b$NhgiKlDP`Zk]ZJ' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
// Enable WP_DEBUG mode
define('WP_DEBUG', true);

// Enable Debug logging to the /wp-content/debug.log file
define('WP_DEBUG_LOG', true);

// Disable display of errors and warnings 
define('WP_DEBUG_DISPLAY', false);
@ini_set('display_errors',0);

// Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
define('SCRIPT_DEBUG', true);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
