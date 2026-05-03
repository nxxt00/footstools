<?php

define('FS_METHOD', 'direct');

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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'db785157562' );

/** MySQL database username */
define( 'DB_USER', 'dbo785157562' );

/** MySQL database password */
define( 'DB_PASSWORD', 'ARDedNqfIIlVVApGfFmt' );

/** MySQL hostname */
define( 'DB_HOST', 'db785157562.hosting-data.io' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'lv*Yo27x,_C-`dFYHdqodYj}[jq1iQ`uV%h?|glq%Wr89Wx@7h+##|(=qJ<>a#.-');
define('SECURE_AUTH_KEY',  '9W4gmU.Z#2|Zi%5W8=l,(=NU9N}9c=Z YTm;2y[:%y9TXnca#A;-A~s`~{s}`-D-');
define('LOGGED_IN_KEY',    'a8#IqeK8~L2rFpIR9}x2JAdZ^ ~XIwk8=S(E!..@aZ9I[Ip*cX-g1M=:[<b^%!z5');
define('NONCE_KEY',        'e6rbH^4j}RwV4E9k#eH|}H*H{_3ndg8uJ>Tcju$^+sSj!p-IP&pEQU@T(t=*,iE1');
define('AUTH_SALT',        'H|~)<5-9}+6ITV6QDpH4WHSr|F*-3+II$6ug6n5qz{mT4R@-whFQbd9=+,F^>w)g');
define('SECURE_AUTH_SALT', '_ztc[8v*bM{;qd<]%:ts85DtS1otdvVb|vyD~dA/m|3eRvs47PiT]c(aJJzY3p<+');
define('LOGGED_IN_SALT',   'moRz4u;Cyeo?zqzZ4)=KgLktMMl0O4Kc|jX,`O{A]rTY;7__Z?H^OCpG|3j(H6L/');
define('NONCE_SALT',       'J1(}lHa-^kl,PRDX-]X0k=WHfg1Ka$XmO-%=<G%{tU5u(:fa:+F|y1J]:x3Zq~jM');


/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'okwsPcdt';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
