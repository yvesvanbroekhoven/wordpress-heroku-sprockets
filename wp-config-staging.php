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

/** Define ENV global */
define("ENV", getenv("WP_ENV"));

/** Parse Heroku ClearDB url */
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define("DB_NAME", trim($url["path"], "/"));

/** MySQL database username */
define("DB_USER", trim($url["user"]));

/** MySQL database password */
define("DB_PASSWORD", trim($url["pass"]));

/** MySQL hostname */
define("DB_HOST", trim($url["host"]));

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/** Allows both foobar.com and foobar.herokuapp.com to load media assets correctly. */
define("WP_SITEURL", "http://" . $_SERVER["HTTP_HOST"]);

/** WP_HOME is your Blog Address (URL). */
define('WP_HOME', "http://" . $_SERVER["HTTP_HOST"]);

/** Disable theme editor */
define('DISALLOW_FILE_EDIT', TRUE);


/**
 * Revisions management
 * http://codex.wordpress.org/Revision_Management
 */
define( 'WP_POST_REVISIONS', 0 );


/**
 * Enable the WordPress Object Cache
 * http://codex.wordpress.org/Class_Reference/WP_Object_Cache
 */
define("WP_CACHE", getenv("WP_CACHE") == "true");


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'cW|-/7 NLf5[YyB0L>?r8gk*!dN%C4+cT#}f8>xXY`>=xJx_=AQ}#`UM.m:mClT&');
define('SECURE_AUTH_KEY',  '}$BT}i8>vasn`W8kN47JN6d|2,oq{i2vMd)<zwSfJ4:}9lsvbkfvD#d4Vl(vb]<6');
define('LOGGED_IN_KEY',    'H4z7-;*ll[hE|:hW)uqy^3^G~+BR)v-8hXQm12LF--p2xlT_ZB3I*|[c)Vl]J?w}');
define('NONCE_KEY',        ':aNQ2+S7aP|go^p7*?Yo*;qLV+,V1s-pHx_w)/xJ-egM=`N+p50Lyai[TenYHmnz');
define('AUTH_SALT',        'Mzxaky?WP|xjgd(hp/h(kIsZiz_qv2oLb2bJGYK~7_!w|7r+mEN3f+gRDiF*#C+K');
define('SECURE_AUTH_SALT', '2lb?M1Gx% _@mF|:T^X=qCl,MjO$6TZJN/|J_7YT)-1R>rg+$|A7W3*QWqiV4&5-');
define('LOGGED_IN_SALT',   'e*1h27s{P@`g>/c+W<~`:7yX1i+tH;l[14 g?h.70|J(<|}xK:h7JOfy@|o3DdH1');
define('NONCE_SALT',       'Z&>sEH|1`0v+Ucv`xxHso##:=mzU67]*kOz8l`Er+R_fj?GH=uSaBC-k:aT6-dsq');

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
