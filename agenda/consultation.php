<?php
// chargement des ressources
require '../include/initialisation.php';

if (isset($_SESSION['membre'])) {
    // chargement des données
    $lesLignes = Agenda::getLesEvenementsAVenirMembre();
} else {
    // chargement des données
    $lesLignes = Agenda::getLesEvenementsAVenir();
}


if ($lesLignes === -1) {
    Std::traiterErreur("Échec lors de la lecture des données : " . Agenda::getError());
}

// chargement de l'interface
$titreFonction = "Consultation de l'agenda du club";
require RACINE . '/include/interface.php';


// Transfert des données côté client
$data = json_encode($lesLignes);
echo "<script> let data = $data </script>";

