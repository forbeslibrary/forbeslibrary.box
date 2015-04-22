<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
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
define('AUTH_KEY',         'cnU8p1w0c2M1Q4F3NB-q(zalulX.yZUUV{KC#n|K/TI S|r>~4b-+Fqtnz7~Y,y>');
define('SECURE_AUTH_KEY',  '5*w&.beA#2T<}:am, U~a`Cw|Ec@RKUbQef6b]e?|.gfD~ae1yLZFPBXlM+?_kdr');
define('LOGGED_IN_KEY',    '=BpzcUeptMONDc:lfyOY}6c,dhHWq0xBgxH+ad!qAJY_l!+Hi6-0| mK^c#lg+%|');
define('NONCE_KEY',        'gS|F<wh/S5CNEK~t$$KFb?=^C6ry-,;NLX0rFrh7+-H~7$=H$mqa[u3d6[=.q+X]');
define('AUTH_SALT',        'UJmA*onyI8o*Dm8RS@g6Lwq6BfqoZ|Ta_TFR$NBky uX[TiADK+JN9C|f%+%cOUl');
define('SECURE_AUTH_SALT', 'I)Oh<V3}6l+=XnssXAgttN^F@qrLY3/r}G>B!O|duSz@QR$3wlOG]GEZ}A4?e<5Y');
define('LOGGED_IN_SALT',   'pUg`zF(($Xrr{%Q.Gk2N$n_nAKM<}B#LZ56BUCnoIgLS1.Gn.h/G)vGsOJ5P)fFX');
define('NONCE_SALT',       'lFJ_D!vN=iH<hb!ALlMP-R_N=^rqw)F+iOJM.2c_Az@9C_Se& Y `w.^f9y:fK3X');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);

/* Enable multisite */
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'localhost:8080');
define('PATH_CURRENT_SITE', '/wordpress/');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
