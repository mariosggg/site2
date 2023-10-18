<?php
/**
 * Οι βασικές ρυθμίσεις για to WordPress
 *
 * Το wp-config.php χρησιμοποιείται από τη δέσμη ενεργειών κατά τη
 * διαδικασία εγκατάστασης. Δεν χρειάζεται να χρησιμοποιήσετε τον ιστότοπο, μπορείτε
 * να αντιγράψετε αυτό το αρχείο ως "wp-config.php" και να συμπληρώσετε τις παραμέτρους.
 *
 * Αυτό το αρχείο περιέχει τις ακόλουθες ρυθμίσεις:
 *
 * * MySQL ρυθμίσεις
 * * Κλειδιά ασφαλείας
 * * Πρόθεμα πινάκων βάσης δεδομένων
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL ρυθμίσεις - Μπορείτε να λάβετε αυτές τις πληροφορίες από τον φιλοξενητή σας ** //
/** Το όνομα της βάσης δεδομένων του WordPress */
define( 'DB_NAME', 'site2' );

/** Ψευδώνυμο χρήσης MySQL */
define( 'DB_USER', 'root' );

/** Συνθηματικό βάσης δεδομένων MySQL */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Charset της βάσηςη δεδομένων που θα χρησιμοποιηθεί στη δημιουργία των πινάκων. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Τύπος Collate της βάσης δεδομένων. Μην το αλλάζετε αν έχετε αμφιβολίες. */
define('DB_COLLATE', '');

/**#@+
 * Μοναδικά κλειδιά πιστοποίησης και Salts.
 *
 * Αλλάξτε τα σε διαφορετικά μοναδικές φράσεις!
 * Μπορείτε να δημιουργήσετε χρησιμοποιώντας {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Μπορείτε να τα αλλάξετε οποτεδήποτε για να ακυρώσετε τα υπάρχοντα cookies. Θα υποχρεώσει όλους χρήστες να επανασυνδεθούν.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '3lrMIUrF{r#QuuOVP>XUvH_yOwi|8$j*^s=GKV;tBQ6j]emy{2OJ0YXUs8P?Z6VG' );
define( 'SECURE_AUTH_KEY',  '`6fj/f/=r-*+3{+__4E-eytEO{ori-:bT@y|_6SSd{7%a@TV^3I3HKrQ8^MnWqCz' );
define( 'LOGGED_IN_KEY',    'jQOfa4j$x/hoZ;m`bf|cze;I=PJQw~.G%AB8U.Xu(Ho0Y[9X`W#>w_-O.{}}J~Dq' );
define( 'NONCE_KEY',        'qU;s|IEbbV*>T_g2_7c._t}rYT0r8dcv]!=<lN9idoWgpr1cbV^-Oktn@64h@2La' );
define( 'AUTH_SALT',        'gKWKj[Im4{G9APHfG]]kwuy)& /Sk7KQw0Q7{`t}NE_pg>Um<rA<r|rKkef5m{`u' );
define( 'SECURE_AUTH_SALT', 'wu+$6 M4@ie7^4vEInOAg`E+BN*an(V@p?`Y:+<[YlNgd(8}F@veVr{`5susg?L5' );
define( 'LOGGED_IN_SALT',   'BL8XwBE>j1VjlLE5udF}.VA6 LrfA%YM%LC)Z}a4U+Nk9R}=!/L#L4[<U%)HJy+!' );
define( 'NONCE_SALT',       '{_gC7fhrl}bK76<^DyX99!aNzh)!-A5rxb}+1oBP=zs:UO%0e)[?1`LP&R= V26O' );

/**#@-*/

/**
 * Πρόθεμα Πίνακα Βάσης Δεδομένων του WordPress.
 *
 * Μπορείτε να έχετε πολλαπλές εγκαταστάσεις σε μια βάση δεδομένων αν δώσετε σε κάθε μία
 * ένα μοναδικό πρόθεμα. Μόνο αριθμοί, γράμματα και κάτω παύλα παρακαλούμε!
 */
$table_prefix = 'wp_';

/**
 * Για προγραμματιστές: Κατάσταση Αποσφαλμάτωσης WordPress (Debugging Mode).
 *
 * Αλλάξτε το σε true για να ενεργοποιήσετε την εμφάνισης ειδοποιήσεων για τη διαδικασία ανάπτυξης.
 * Η χρήση WP_DEBUG προτείνεται για τους δημιουργούς προσθέτων και θεμάτων
 * στο περιβάλλον ανάπτυξης τους.
 *
 * Για πληροφορίες για άλλες σταθερές που μπορούν να χρησιμοποιηθούν για αποσφαλμάτωση,
 * επισκεφθείτε το Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Αυτό είναι όλο, σταματήστε γράφετε! Χαρούμενο blogging. */

/** Η απόλυτη διαδρομή τον κατάλογο του WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Ορίζει τις μεταβλητές και τα περιλαμβανόμενα αρχεία WordPress. */
require_once(ABSPATH . 'wp-settings.php');
