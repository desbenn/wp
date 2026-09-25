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
define('DB_NAME', 'wp');

/** Database username */
define('DB_USER', 'root');

/** Database password */
define('DB_PASSWORD', '?Des12300!');

/** Database hostname */
define('DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/* * #@+
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
define('AUTH_KEY', 'HrdfFIj%g$U6uq+GTN7J7E8L%9}:^0,PxMjWL$NRww2Zh-*P|`41B!>U,K<6e/x3');
define('SECURE_AUTH_KEY', 'Z%5XwP _tAaG,aVr9H(`~C-%SA&L0E!s+8?4|#%fD=o )ZV-[`5^@(7&))]Buj)n');
define('LOGGED_IN_KEY', '{/uSl[N*6G{wZ8F;SYt{jPd$+;nExU@`jW@IaG;k.EH&-&x3B9[Hqb*|m+>7` bB');
define('NONCE_KEY', ' AB515,)Pz6_gDm{{lY`*zk`WAIYuGOTH~:^cjjZZw8>Q+iIKAFsd^B{NM%9_~:Y');
define('AUTH_SALT', '-(.I5E}_MtCLb<n`OG*F+8Wm<6EENMwdk{Pp&S(XVV{~gEY;>ezK$2&]Q,`mOq#Q');
define('SECURE_AUTH_SALT', 'kdzo#KK_ aMTf<~sm=o%y~qiQD=J-zDZi[wb;j4D9;|iLQ(z[GtFl!$|wI!BxqTu');
define('LOGGED_IN_SALT', '{v,yE C*:LmQ-C5xdM35%+m37Pv##YTX~t%e4H7 iBQmfj}?k9tZ.Go._fjB3uqR');
define('NONCE_SALT', '$b^v%8HJ}bkoH7B6>YJ8Vb23)T_M&6^x`x9R5eJPu_$LsZv#qTK0k&=L1.QWc^m2');

/* * #@- */

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
define('WP_DEBUG', false);

/* Add any custom values between this line and the "stop editing" line... */

define( 'WP_DEBUG', true ); 

if ($_SERVER['HTTP_HOST'] === 'localhost') {
    define('WP_HOME', 'http://localhost/wp');
    define('WP_SITEURL', 'http://localhost/wp');
} else {
    define('WP_HOME', 'https://app.adassa.com.jm/wp');
    define('WP_SITEURL', 'https://app.adassa.com.jm/wp');
}

if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
        $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
