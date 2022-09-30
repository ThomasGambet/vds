<?php
/**
 *  ajouter un nouveau partenaire
 * Appel : partenaire/ajout.js
 * Résultat : 1 ou message d'erreur
 */


require '../../include/initialisation.php';
require '../../include/controleacces.php';

// Vérification des paramètres attendus
if (!Controle::existe('nom', 'logo')) {
    echo "Paramètre manquant";
    exit;
}

// récupération des valeurs transmises
$nom = strtoupper($_POST["nom"]);
$logo = $_POST["logo"];


