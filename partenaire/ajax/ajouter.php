<?php
/**
 *  Ajouter un logo dans les partenaires
 * Appel : partenaire/modification.js
 * Résultat : 1 ou message d'erreur
 */

require '../../include/initialisation.php';
require '../../include/controleacces.php';

const REP_PHOTO = RACINE . '/data/logopartenaire/';

// contrôle de l'existence des paramètres attendus
if (!Controle::existe('nom')) {
    echo "Nom manquant";
    exit;
}

if (!isset($_FILES['fichier'])) {
    echo "Logo manquant";
    exit;
}

// récupération des données transmises
$nom = strtoupper($_POST["nom"]);
$tmp = $_FILES['fichier']['tmp_name'];
$nomFichier = $_FILES['fichier']['name'];
$type = $_FILES['fichier']['type'];
$taille = $_FILES['fichier']['size'];


// Définition des contraintes à respecter
$tailleMax = 300 * 100;
$lesExtensions = ["jpg", "png"];
$lesTypes = ["image/pjpeg", "image/jpeg", "x-png", "image/png"];

// vérification de la taille
if ($taille > $tailleMax) {
    echo "La taille du logo dépasse la taille autorisée";
    exit;
}

// vérification de l'extension
$extension = pathinfo($nomFichier, PATHINFO_EXTENSION);
if (!in_array($extension, $lesExtensions)) {
    echo "Extension du logo non acceptée";
    exit;
}

// vérification du type MIME
$type = mime_content_type($tmp);
if (!in_array($type, $lesTypes)) {
    echo "Type de logo non accepté";
    exit;
}


// Ajout éventuel d'un suffixe sur le nom de la nouvelle photo en cas de doublon
$nomLogo = pathinfo($nomFichier, PATHINFO_FILENAME);
$i = 1;
while (file_exists(REP_PHOTO . $nomFichier)) $nomFichier = "$nomLogo(" . $i++ . ").$extension";

// copie sur le serveur
copy($tmp, REP_PHOTO . $nomFichier);

$reponse = "";
Partenaire::ajouter($nom, $nomFichier, $reponse);
echo 1;


