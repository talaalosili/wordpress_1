<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
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
define( 'AUTH_KEY',         'p4r#%fqKHL*Y7b3:/?d>C8_I-#Ol?ZJaQ|[q=}mH01R@fD95ox<t|iO`%kRZSWx@' );
define( 'SECURE_AUTH_KEY',  'U`WNl5*Cv_l&.D!w]c(rMoG$$[:@I!OdILP6Wf~}3>DQPTn}akp;>&)k1}PV0Z_D' );
define( 'LOGGED_IN_KEY',    '/.>NwU4b`wlphm.!$8wy1@O}{HB=+K6ro(rVc+(jYKH-;i%}XF5+<a FJ:d,6:Oq' );
define( 'NONCE_KEY',        'OE$4;y6vkDYjpa<29L)/XEu aF{n&ns=Yw5s;;EU}y]FI0Wd7P`5[gQ}a)1oIMYI' );
define( 'AUTH_SALT',        '!a9WvqqP6;Cs+:s#8tiY3}&JAcA?xUyw/22}KiHk,*;`{{V.)G-?w9,}b({+!CJF' );
define( 'SECURE_AUTH_SALT', '2+8&N,(n$DW BPV$EjM$RW=X^%#xD,9@Frj|JAILUCQ[O7MLzO@{MHFwDARJgoEp' );
define( 'LOGGED_IN_SALT',   '.;4#Cp:@`Rq?x:P T~LY}zU4(ly3 _fAJx<+y>!FN= l2F`MfY;EMLT9l$x6VyO7' );
define( 'NONCE_SALT',       'rM0d+sih7{D:S^&+~&lF@7C<M+9k{7F3&<~?mz]lzN%1g,-G)HC)m?%[+)b{Dj!z' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
