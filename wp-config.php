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
define( 'DB_NAME', 'university' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'm%-;2N+kIMvvRDv.08:)[X<>kD#WZQd+hFu,e[08L|ug|7u)UKB3rN$@ T*;UDk$' );
define( 'SECURE_AUTH_KEY',  '63mtsS6x9~;!2 dXTxae+fJQ0=-o!}83pxWHxIpgqg4D@q c`5Bm9HJdSO?8zxs;' );
define( 'LOGGED_IN_KEY',    '4xLl$SHK&.0%!!#I-;qGi:.NfSqU[thZ#iqb `M8||(1 =9,9H,RiB%IR?N_|muk' );
define( 'NONCE_KEY',        'Vxo @:fi9Db6(MMaClXUe$_.=2o1kipy*46q-AuM#E6 [o&`N_+hY*>_,NdQ:Lgh' );
define( 'AUTH_SALT',        ',z8#N3b;3D#U&pc!_FlQa0zc$o@LqTLe#`]8UZOSMb75fjG=)7W`rwwgn6bBMnll' );
define( 'SECURE_AUTH_SALT', '0H=|/oCbV2+Dgd^yvyKB.c1*BOi,uR=>uxX22N|< <;V|T0:r&t*+^dJy~xn$8!E' );
define( 'LOGGED_IN_SALT',   'JMRTT&~K=gA@:v{!U]$e%q$XV]L5(d|q]^:`rWPFhQ){S`y~)/99|}ugcC6gpfSW' );
define( 'NONCE_SALT',       'LdDIvy5xfQ@9qukA<XhZ3Hs5P#St)E{00^V)%gT/c biVu}jBz-^,LJ^Bm|OdOD0' );

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
