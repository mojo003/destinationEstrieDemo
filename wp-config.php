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
define( 'DB_NAME', 'wptp' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'm[c;^WZ@sV2Y`eSw%jYA9tS6X#By|rc~wVuruAl^h %sAm0?$$Ix|?owYi7GZoN^' );
define( 'SECURE_AUTH_KEY',  'S/XyGlr<Dp/V%I|2F>I3Wpbv4Q*cBB!{a$.DD{H.^8<^uF@]I&h&?{z3&Lj6<-WV' );
define( 'LOGGED_IN_KEY',    '%{jw,$=F6.txeIS89Vb/se{EDZ/iAp:Hwhyp$$FW0{1o}R?;,Lda9YzFR.mX.afz' );
define( 'NONCE_KEY',        'i7{kgB#=p4!!`(Yf!^`Cg#wHeA#%T,MH~wxd1Bo^~[L=&2*M?);@bsUnK)O=Cr+s' );
define( 'AUTH_SALT',        'hVp].1,NFN6C3I4BBxy5AT1JY>hy7oS~x?NUwf9+J=h:?JMa:ojS1CxS -]YQqjs' );
define( 'SECURE_AUTH_SALT', 'pUxr&tF?2KCy/NC, b6<@iS`vt?sDr7l0NNA*)[v=HjsX](_`b8Q,_CKw}:%_Q@Q' );
define( 'LOGGED_IN_SALT',   '{,lYqgig>0w=0{NzOZ%5^38^O<TJ%Ii/k%~qY~v:,~#IZX;e9y-$ZDO$^+s4?UZe' );
define( 'NONCE_SALT',       '=CH=0V~dip]a)9#U:r_Ao0:T>]npzTh@;rl]taht7Ysq%p6|T`&jfisK--+B}:J:' );

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


