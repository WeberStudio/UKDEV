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
define('DB_NAME', 'ukopencollege');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'uyj/6J.w`VVzEfy(b<,/IBMWE)+{sAh:q--,TL/YrH#P.!bKvO$$wHTxKjCnBO%^');
define('SECURE_AUTH_KEY',  'zrub}UHd%;:>AY@HcV9O8Dw[84>1US!#&2Cyy32!4ik@%g=~|X~.U,)PnH -n,S=');
define('LOGGED_IN_KEY',    '^$bjPQcYUoh6GtJF51KUTzzd5mN@WB~@BR&1k]HlK3|rG-[]Ydbtu(/$6D{t. 3P');
define('NONCE_KEY',        'qDyD{Y?|Cn_z(,% <f2N%I%pGYq07.|Xp%Q&:t]gFJ+g%~J*P(X/iDE9wIz{P7R?');
define('AUTH_SALT',        'mR/)7=K#h6jcTn*1;xo5)JYg_?P+Ie={>o,62bfI-Z+570a9@OY&NU|y{~N_C/Ig');
define('SECURE_AUTH_SALT', '2CN0a1K3:83w&Q)0^2{aEA<E.hC06bw@1T0H*@m965}~<$Q{`kD+XHn;N3m0w^oE');
define('LOGGED_IN_SALT',   '5^aQg&@CdqW[avh|bi`Ff<|Qkz}qQS)k:ag%v0~5DK )z]]U7I:5enD1`fEv7k$S');
define('NONCE_SALT',       'R{!8Ff)CHmk_E&vUs,5OuPvEjP_]YJ-P4%Z7x,lVM>5DXXbkPbdi}p=~UeU%cFyD');

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
