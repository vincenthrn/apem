<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'apem');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'root');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '4am^l2x8 *0CWgB.4qi6O&,4xa2Q*pa K=OKUb`6@Q-D?![e@H=Cmy#8:BoQe_>Q');
define('SECURE_AUTH_KEY',  '$7R9H d8<Mw ^6v>,iM{uq4)+.E- Iz+x4dz0DJ&l2lYq1K<maOcJ.{agg=U}m?8');
define('LOGGED_IN_KEY',    ',pRm^7Nh/^u?])Z.P/A.T Xz*$/1&f6:3*25i8?;]/UYCR:r|i/}k!YC2wM-B;&/');
define('NONCE_KEY',        '18K?mE%oHave|ISuHuhi <nZ&{]46iU4vb%Y}v?_bX`*mngdXc3/Q84ZPI<n~>K=');
define('AUTH_SALT',        '@cF+jShwT)&hg!RsYyp6hB,iUGyk[Ro8=^/H-p+:p<ji5+[TptvL3C!DIyhORz4L');
define('SECURE_AUTH_SALT', '}m}a5W`EK[).>g$HL^z9p;nc.-aN(hW:x?|)HCT*j~#t>[#Ap.^<D7ZOz1t z/Pf');
define('LOGGED_IN_SALT',   'tX~!0K7v<#D/AD.U q?X+43&ut,c0Za)4?8vRzcfI{>Z!upHfLWCR`kSE_hsVn#A');
define('NONCE_SALT',       'EG| t96Ojj:nylc;/HQ8J/0pJbs!m3a=wx>#n>/{[mI)JxwHdG5PSJ60OA-r6Yfy');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');