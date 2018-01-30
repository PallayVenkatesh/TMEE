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
define('DB_NAME', 'wordpress');

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
define('AUTH_KEY',         'h_/Jkb4s2ykd=>J{u $hJ~UI8+8@] [4N ?K[23)33/!E),DySjfm<C[=YeMLMq&');
define('SECURE_AUTH_KEY',  ' #qb*C3e+ &%m-rI/z[D,Zg.=0#>d+C=*&-kFZDGZ{X~y[hp<:@yRTi0-Q!LkM2q');
define('LOGGED_IN_KEY',    ' 0g d7Erw`u~VBG&hDStKU8OA*C~J/EBvYn6S57~{(fpX#^c7TA{93-41[7,=7+n');
define('NONCE_KEY',        'v9#/X@)@egr)_A)BSUDc1+!LsQk~w*^t9w3PJ1+WNZ4G{]F6odLSV6~-xWit_)`5');
define('AUTH_SALT',        'G;p>&DV;(:BWK=T#xG4&5dZqdNL9,A_cDha_$huL8.&lVKefQ>Gij`|mE{{#6:N.');
define('SECURE_AUTH_SALT', 'jV*Uz,:lzLV{b4PoRzB}@ k/[{y(XF,u@<.vxSn4:/q?m%=(V)J&vUlE21nX%N6Q');
define('LOGGED_IN_SALT',   'pmT7k{N/R:u{spu0b0i4IvVmbLCM`ldLO[;5mlswBc),G;]_Ws0D#c<q9T8T?iMb');
define('NONCE_SALT',       'J Rrb+;dd80~07;daDj~>k%%Q`ZLaGDq2j[m0e;/a27w bR$o,5rVyBN_Sq<[T6:');

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
