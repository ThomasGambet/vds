<?php
// chargement des ressources
require "../include/initialisation.php";

// chargement des données
$url = "http://formation/api/calendrier/";
/*$lesLignes = json_decode(file_get_contents($url), true);*/

// solution avec le composant guzzlehttp
require RACINE . '/vendor/autoload.php';
$client = new \GuzzleHttp\Client();
$response = $client->request('GET', $url);
$lesLignes = json_decode($response->getBody(), true);

if (isset($lesLignes['message'])) {
    Std::traiterErreur("Échec lors de la lecture des données : " . $lesLignes['message']);
}

// chargement de l'interface
$titreFonction = "Calendrier des courses";
require RACINE . "/include/interface.php";

// transfert des données côté client
$data = json_encode($lesLignes);
echo "<script>let data = $data </script>";
