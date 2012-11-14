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
define('DB_NAME', 'fs2011');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'Machka84');

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
define('AUTH_KEY',         'nH1zo:R4D,RB^Me.z+9}p~a){6O>~Qjj]JQ{p3Ft+We*}ASAHRU psq`Yb!*Fs@R');
define('SECURE_AUTH_KEY',  '.Z:s+hz`rI[,-69yGPS(g#haFf4w0e]c(qcUQT.pe-l*vTbXbdBNG8y&-0wg;q!u');
define('LOGGED_IN_KEY',    'a:Uy3Lr1b;Ir|)0ti2CO=9=?N>C4&9%%Wbq x:;}+N-=<8Sv5sdj-/%Ms[(a%q#_');
define('NONCE_KEY',        ' 0+]VQ`[a-Ww~N`H=Y641$l-yy8m#n)QlL=|4#,g#2E+~ ?#Trs61TqHj,n7W,0(');
define('AUTH_SALT',        '.,!?W}S83D+B<[P`S>,B>Vt7Lq%aL^@~(f];|WO1C/.#q{pW+26dD.!?TPMsK<|@');
define('SECURE_AUTH_SALT', 'Eeugo`Z)!2v0 Xp_**o>-iuDrsCm:w+Thm%2({Tu3?uj-OE]*7{MYl/iK!4+P=jg');
define('LOGGED_IN_SALT',   'f8KUh<Dug0/xlv{03>+/&*RBLNpJKv ALA5NiiyiaZj;[KoJ()_V:D}-6G|bD@q|');
define('NONCE_SALT',       '3fH F$Qh`QTx4Br7A<L+w1v5MR:v-E|rOnfOQHaUvbXDK~hLI/K5]sg~Nx7Zr%b)');

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
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', '');

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
