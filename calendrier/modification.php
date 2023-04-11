<?php
// Affichage de l'interface de modification
// donnée transmise par la méthode GET : numero

// chargement des ressources
require "../include/initialisation.php";

// récupération de l'enregistrement correspondant
$numero = $_GET['numero'];
$url = "http://formation/api/calendrier/$numero";

//$ligne = json_decode(file_get_contents($url), true);

// solution avec le composant guzzlehttp
require RACINE . '/vendor/autoload.php';
$client = new \GuzzleHttp\Client();
$response = $client->request('GET', $url);
$ligne = json_decode($response->getBody(), true);


if (isset($ligne['message'])) {
    Std::traiterErreur("Échec lors de la lecture des données : " . $ligne['message']);
}


// chargement de la page
// intervalle accepté pour la date de l'événement : dans l'annèe à venir
$min = date('Y-m-d');
$max = date("Y-m-d", strtotime("+1 year"));
$titreFonction = "Modification d'une épreuve du calendrier";
require RACINE . "/include/interface.php";

// transfert des données côté client
$data = json_encode($ligne);
echo "<script>let data = $data </script>";