<?php
$racine = $_SERVER['DOCUMENT_ROOT'];

require "$racine/vendor/autoload.php";


$dbHost = 'localhost';
$dbUser = 'root';
$dbPassword = '';
$dbBase = 'vds';

$date = date('Y-m-d');
$fichier = "$racine/data/sauvegarde/$date.sql";

use Ifsnop\Mysqldump as IMysqldump;

$lesParametres = [
    'add-drop-database' => true,
    'add-drop-trigger' => false,
    'databases' => true,
    'routines' => true,
    'skip-definer' => true
];

try {
    $dump = new IMysqldump\Mysqldump("mysql:host=$dbHost;dbname=$dbBase", $dbUser, $dbPassword, $lesParametres);
    $dump->start($fichier);
} catch (Exception $e) {
    echo 'La sauvegarde a échoué : ' . $e->getMessage();
    exit;
}

// transfert
$connexion = ftp_connect('ftp-thomasgambet.alwaysdata.net');
ftp_login($connexion, 'thomasgambet', 'Slam.Sisr.2023');
ftp_pasv($connexion, true);

if (ftp_fput($connexion, "/sauvegarde/$date.sql", $fichier, FTP_ASCII)) {
    echo 1;
} else {
    echo 'La sauvegarde a réussi mais son exportation à échoué: ';
}
ftp_close($connexion);