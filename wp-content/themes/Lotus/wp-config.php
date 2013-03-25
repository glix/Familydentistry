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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'logiciel_family');

/** MySQL database username */
define('DB_USER', 'family');

/** MySQL database password */
define('DB_PASSWORD', 'logiciel');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'q17fu~Uq;>^kWV6fDf_9|rkcsE{*JvcX!5lKWEni7B WJ_8=;P&RoN}$$M;BAu`O');
define('SECURE_AUTH_KEY',  'kr7K`/N~)[|z|r_k{v xZ{0v/&7ytLd(F0NI/v+{=2A7F)>dym2!Dd]Kj3O.74W{');
define('LOGGED_IN_KEY',    ':bsvJ0{4f5:sC^Pm3[pAQhpn?^dD-C-)pB80Kh/Fppt+/;FPU!jFJ2oNsBI<_W7n');
define('NONCE_KEY',        '9[,LvTQxrU_.*sq._Bs>_#:LBBY3Gl !8KHlDqm}ll|O*X^~ cBBR,rc$e&(j}78');
define('AUTH_SALT',        ']hltJOIejjVd8Z?u[}Ho$I`IN0g4_5VIII?*O7Ir834qdNGKAOF38s@/Gef~=Z:C');
define('SECURE_AUTH_SALT', ')8p4Gq[D:!P.kmNgQmTRqI#tBHFaCa-%dm}sZ@=Njr<l#@-Z.+&)5r9Uf4p.@3q&');
define('LOGGED_IN_SALT',   'D5J0{)Npp5&6cT~Q4#D0L!X5&~z)M>snK|vgO;~]$`YF#EvpkArK@2]c7e}IcjMV');
define('NONCE_SALT',       ')YiMEnDd^IH9l#oBVr6vt)ywmf;wW3n?)MD7nM! I-#2D +$.IJimLRu_h(Gp_lu');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
