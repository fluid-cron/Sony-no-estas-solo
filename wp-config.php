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
define('DB_NAME', 'sony-noestassolo');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'cron');

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
define('AUTH_KEY',         'yyJk@#9irei=6!#/NBpP<L^ERCo9bbQQ@*Jq4Hxa$-qu{K2e^J^X-#s;;m[x3[!W');
define('SECURE_AUTH_KEY',  '**`)hf2*b4b[!Vz+!(?4*&G-<7wZB@+[%R7F=;Yg}7%ci@Vybf3*rLd.W`=X/1F}');
define('LOGGED_IN_KEY',    'V6V1p>!o&,9j69dKi*&sY54Ms<rna@-Ez;; Gl((WFv;maKQ9c/O8;la%V0tk:YT');
define('NONCE_KEY',        '@yb?MupnW)x5yR4)Of}qDa,I%bVF:>3uCQL0K6cnWF+$7I,}Jx9dAzPFlK*7&qZ+');
define('AUTH_SALT',        '4W)3,d 9g&ba.+H.*YW$KbqCv#fdOoZh<R7mY&C)@3U:(y98VMCji2|}u{NWcG^M');
define('SECURE_AUTH_SALT', '#]Sq&4p$1qr^O.UmXkEvwU=9`Z8$zS>i1}v{,?j{juwXxQC;Je(S}-M9.QD3pTY+');
define('LOGGED_IN_SALT',   'G:}Br3]L,+NKq4r+4X&I+aj|BK(*~,FQn{  ::noa>lvJmZ5{|ws)T3|P1RHQ&gt');
define('NONCE_SALT',       '|DBpwUbLY:&;mzEee<JjpwxM(Wo=QlqDk?{Wqix,vLh(!BLby7YjuYo*_pu&G{uL');

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
