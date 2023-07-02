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
define( 'DB_NAME', 'uriumpk875' );

/** Database username */
define( 'DB_USER', 'uriumpk875' );

/** Database password */
define( 'DB_PASSWORD', 'qtnCKjqYv3Mxaop5' );

/** Database hostname */
define( 'DB_HOST', 'uriumpk875.mysql.db' );

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
define( 'AUTH_KEY',         'fQ0AR;sb@&kV%?RLp*jsN+bfV]QsjxF1MEODqg.t&rMcjfMjv,sLF~5P.zG`>#Tg' );
define( 'SECURE_AUTH_KEY',  'q!tXoKl$XOr%t#OMN3FWnlD4pIJ>ReQd1,uIO+7LMCa=Y4YEtu-Pyy?ngU`!p5Jw' );
define( 'LOGGED_IN_KEY',    '#&W<{8HlXi*~0%g&k_ F~M q22`8wnX^[K7/M#)+-jQBI+N$9kr g#w67Ip;gu9V' );
define( 'NONCE_KEY',        'I(=i.(<]tg_(aH]mUfxdNjiO2!v+h+e[5{t|@D_%L&YQ!{pw0C/3|y?#x#TP;4j ' );
define( 'AUTH_SALT',        '(w0N+1NJ(#{y3BrJm{I%|+!KKZH7!GU&d0~Mj2h.Ag:W-f61V{:Kx})O?}bR.^wI' );
define( 'SECURE_AUTH_SALT', 'D0otSfo#bclwCGZ|[A1x&jZhhf$#IZn%%5dCm(?m15plsF.M%iu-7|d[z(iRy8^U' );
define( 'LOGGED_IN_SALT',   'yWw$fD+O)[ghUKm-gadLJo|0SyThmfX=HY_5/n%?6+}KWq>#52B(~PA7Y-fO[Zsi' );
define( 'NONCE_SALT',       'j.2@sj$sENIZaBcVydfnyf=2y6~si7J}y@aX5D05walnot^)$@g<WIqYcvrmmAIN' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'upp_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
