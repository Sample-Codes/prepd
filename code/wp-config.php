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
define('DB_NAME', 'prep');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         ']sh8P,o/H9?hV+?ZQQ l*GFgx*|feil.:c)S4w+Xr/W4Z$K(NC/<%4j`L_zH|sT8');
define('SECURE_AUTH_KEY',  '<SP>D7dL0QyzR9+C1[|(?bHm&C&+;]%eQI,QWY{Xj[0Z5~a}M~*!wWw[0+-pCXdo');
define('LOGGED_IN_KEY',    '2Dt5-3MN&sT_~pWPMQl VV;O1%%c}^ZOZ3.hy8)Fr-L9q&a%oRfPaA{F3-EzYz35');
define('NONCE_KEY',        'M$w,y6E]p>I$p.U&:bRP$Yoeh15N[`*p3aKCv|GegHKbNv `ujT}XJOGWR:;poe7');
define('AUTH_SALT',        'Nh>FR-9-TBG*hOrjuDEg8h~jcjUViVNZL-RzTy&?N2W6/`Ee;KQj@qY]f?0MPBOP');
define('SECURE_AUTH_SALT', 'J 3uW6e#S2FU 3$Tdwts|ud=P]cFVy7q5jAWDs7&x#qMzf4R>_qdjIv3}(|;sZ9.');
define('LOGGED_IN_SALT',   'LD[%=S*/6>Vcj5BCmnv3$S;grnXRey~jYdT6]o|%$>5vPTZBeEA01&,wB3; M#/s');
define('NONCE_SALT',       '_=I0CG6Pn)n83_b,;lqjzm} o!&VCO.+Wr~z5Vb,ysX6fJvN1>y<s%RD/KP%6!vX');

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
