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
define( 'AUTH_KEY',         '~S>y+%bA20I<sk<lRHq .-.@Z]7+}gjj.D[91KiI=H4].v4;*S6!Y3>F<mn1>jWC' );
define( 'SECURE_AUTH_KEY',  'K2@R2YIK!5hB2T^q5CoY?aI$,[,Pu2[tG?75U(vVxZug.v@iBYI2qK1.S( Z?bP/' );
define( 'LOGGED_IN_KEY',    'fMkxY~M5Z2elXw6t<=Ie ,5mrmcR,:~E_v-W|yV~tBIibGF|P{d@XwkZDfx+JGm=' );
define( 'NONCE_KEY',        'tapV=_6v5;.c.$QQsf#*d(%^Qd|po;`<47LeF_a3jN~rv{.vomd|h1fSSAEl<95R' );
define( 'AUTH_SALT',        '#<{~2euNH;go-;(HL>NeK/e6g!J jsguR`lB;6 ^.YkW%e.sVV[[;7L`(;L&sDCg' );
define( 'SECURE_AUTH_SALT', 'd;`^5|R%nr5m|q>gJnuuu Zi&>FWDwV}HIZO)ns|jg-j`21f4@)Ny~?xi/VJy~@l' );
define( 'LOGGED_IN_SALT',   'ICF5EZ eKQ#b0c[>J`.qpn_REfpCq~vdKqBV#=$^|HY{RSA-7uL0=T=Kq;FmAVgl' );
define( 'NONCE_SALT',       'F*?>cS=aCjJiM>@`=feghF2/.HNd%Qp{b3?]Ps69AJ+HEdyo8g#LdzkPsEcjFk#P' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
