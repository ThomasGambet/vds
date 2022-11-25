<?php

/**
 *  Enregistrement de la modification du mot de passe suite à un oubli
 * Appel : profil/oublis.js fonction initialiser
 * Résultat envoyé : 1 ok 2 : mot de passe non conforme 3 : code incorrect 4 : code plus valide ou message d'erreur
 */

require '../../include/initialisation.php';

// vérification des données attendues
if (!Controle::existe('password', 'code', 'login')) {
    echo "Paramètre manquant";
    exit;
}

// récupération des données
$password = $_POST["password"];
$login = $_POST["login"];
$code = $_POST["code"];


// Cas 1 : la durée de validité du code est dépassée


// Cas 2 : Le code n'est pas correct
$code = $_POST['code'];
if ($code != $_SESSION['code']) {
    echo "Code de vérification incorrect";
    exit;
}

// Cas 3 : le mot de passe ne respecte pas les règles de sécurité


// Cas 4 : Tout est ok Mise à jour du mot de passe et suppression du cookie et de la variable de session

$sql = <<<EOD


EOD;
$db = Database::getInstance();
$curseur = $db->prepare($sql);
$curseur->bindParam('login', $login);
$curseur->bindParam('password', $password);
$curseur->execute();
// suppression de la variable de session


// suppression du cookie associé

echo 1;
