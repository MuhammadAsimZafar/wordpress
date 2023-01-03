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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_db' );

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
define( 'AUTH_KEY',         '4rlXmHcJ|CCG&D1_Qc^:*}XZ%RZBKE*hDk~1`B+la@DFPs#c.8;b(7b.lmfr?<Q8' );
define( 'SECURE_AUTH_KEY',  'b)J{M3-YUxMTb|#WeFB8ij,u t(/]H ` %aUNAMW.~HJv]bm6F@a|J<Y+HYh+#$y' );
define( 'LOGGED_IN_KEY',    'hx<[ua=QrhS,!9M@DlWB+>&y>H$xcr?|{I2gf(U)O{m$,CKvm}}7[m%GY}W&b=QS' );
define( 'NONCE_KEY',        '/#b9GCP |.txEaRtP-]8p%x|`53hKxiDMXf4_8Lr8xND)9[F~a!xb a*I:/T.*_v' );
define( 'AUTH_SALT',        'RNAT9L6E6WdT05g{6tU[q/%|_2sMBH+/%u0X!>*QsB55e+5%D~K?7@Xgwj;|c;|;' );
define( 'SECURE_AUTH_SALT', 'Z)R0z#@:_0?BXx<ofM|{fVK7+w:qok2`V7rd5D>*4MxiJ|,=5CZITF2M+Wm9-0Lv' );
define( 'LOGGED_IN_SALT',   't.G}V9^t;XD0Z &.?Qs4;mV.EA)UfthNLfRSC~&QH)0QwPj;/7z7(i+m=~=l7Hw|' );
define( 'NONCE_SALT',       'baU=bt&wJXc._5hXqfZI(_Q[kSZ!=n-N[U?SRm{OrhwoFpG)38l6d_^^vo[Ne|fL' );

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
