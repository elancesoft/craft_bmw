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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'elancefoxvn_bmwgoldcup' );

/** MySQL database username */
define( 'DB_USER', 'elancefoxvn_dev' );

/** MySQL database password */
define( 'DB_PASSWORD', 'devDEV123!@#' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         'vGlE9rxP,dd&U]slA_Xh|018P-ENvzlDhl(qeK)+Jd221Oqk)o`brJ%/_%1f/}k7' );
define( 'SECURE_AUTH_KEY',  'pw|Is2M?HPG*XAv|q;yQKm,tH .te.n-|&p/InI*X8d=9c+dlU]=hs0Sd-a8;KfH' );
define( 'LOGGED_IN_KEY',    '4^J?`c)w)s~&7<<Mxg{z+<DF{k]I*8(6**S]F<{;6]L^X{)dj2RZ`KusEzaX(6|7' );
define( 'NONCE_KEY',        'frzC<?~}Bj9<Yf)&2iOpoAFZmN (/11!ZFr[(rzVdUZ*z#cEYV3a?#8EcwK!i[}D' );
define( 'AUTH_SALT',        'H?BgDv9k#| `0vPYD@Z(=1;+<BfcaxGmkeV>2rykj{K]oO)$,E=WSgG(+#Uw1n@9' );
define( 'SECURE_AUTH_SALT', 'yZ02qPw]]8yVA3jM@k8Eigt@8uX488Qj G^Yp~HwvAf6wtvRQe@b0j;8|{fav$^>' );
define( 'LOGGED_IN_SALT',   '5PdNG4?SkI;`#bBP:+)c{%YxGLyb;u,vpbGobM~J?!_i}<)uNak@AbYfTvYE~}6^' );
define( 'NONCE_SALT',       'q^ [=`*E>lC.;e]E3tKfFSzd0M960uNYCCs_f{l$8,5+EY?FT=d;>/FzH0v>/fbQ' );

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
