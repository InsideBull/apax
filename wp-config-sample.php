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
define('DB_NAME', 'apax');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '7J$p%1*Bzg1c(eGu6]Hu$1wde9)?j}fpwLfI9JNw!b[`9eCnpcB){oe72z@vr)W0');
define('SECURE_AUTH_KEY',  'hxqdw_[vwU:2gj0<rV`=16Som<U#o9U=]/{Z%L?KEr}$zqEmovA *2$BS1s`YNl0');
define('LOGGED_IN_KEY',    't~8LJ0)1L0eQr>t6~btMU(CE/5Fop5EjgfdM5^L`aLPXQi3Dch(R&})6Bso$)mg]');
define('NONCE_KEY',        'Zen%&DpAyF;}Nb=i~ZryHI~wAYht%%9LXzC$`o)Yiup(/q_2PL`W>xW*~|ytdES=');
define('AUTH_SALT',        'GTCw2,fY9Y<}<~y:J[I^%%L^H+UgWBA!1.s<G4NA}:fdqAgg-*=DgKfqyF|HUvP4');
define('SECURE_AUTH_SALT', ',hZ9x2vXSUh8-!k/,Yp8R#3Pw|[MbVqSK(($XU=X|c4>9a-/miK#_Ym$q*eHpP2[');
define('LOGGED_IN_SALT',   'Fb8eB+Oc(0NK91X(a:<<#KS?6`j|}D~Z{Bctz}p[}{K7Ze&`J@^(N%+x`G60#}cE');
define('NONCE_SALT',       '|Bv1(@7}jipDgtAQdnw{Z[PP_<`(L<[@h`^8OOZJONt>_)|7Xczp>R>{ioIVMtR7');
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