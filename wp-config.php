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
define('DB_NAME', 'alwd.org');

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
define('AUTH_KEY',         '_F.T*?*5[6[hY;.005KaY1D5aCL}+A_vbYGa3|1ZAYF2-3;Gc>+%vSNs|Ec*oX8.');
define('SECURE_AUTH_KEY',  '.qw_~=!,Mu#Uf6)BQy`}}!SQ!{I5L;)qx3;[kzcbi/C26a3X:9C8XlW51JaTXUw[');
define('LOGGED_IN_KEY',    'aL$ [3F7(l7.[E)rNOY&eaC{1&1fq(;1AZsB<Un<%Bb|%]WwI[aCj.rQ^-J8;g_,');
define('NONCE_KEY',        ')q[?{P|a3^O3{<~6}F%z=jb5;bTO!^{A:GE6+##+k4$0&2Qh^+(Kp7fj&|#o[;m(');
define('AUTH_SALT',        'Sb6e%@sF}zbaGK#Uw{rSOMHPJlD_u:bGnk{1,vx0`e,!Zt!&FQR478Ct8:T$So%z');
define('SECURE_AUTH_SALT', 'dQ5sUZE;&FE*dU:B.8HJP(~Aw$Pl<b<=FyM_jz,vhRRmeJ/i:M@nFF%Tb7D(7NCa');
define('LOGGED_IN_SALT',   '|&gUX7%3oroax:A[_5vqOj/TS>K=|/R~=>}75>Gcvl3&m89CdAJ b~YY0*WL}a/A');
define('NONCE_SALT',       ')[QxGS7P$Ta2G0$&vvg~q,zSo}LHnFyEGJ_*tV@tK1NslPb[<>97F*/[HR3p}_J[');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
