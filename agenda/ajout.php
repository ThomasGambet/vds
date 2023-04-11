<?php
// chargement des ressources
require '../include/initialisation.php';

// contrôle d'accès
require RACINE . '/include/controleacces.php';

// chargement de l'interface
// intervalle accepté pour la date de l'événement : dans plus de 6 jours, mais dans l'année à venir
$titreFonction = "Ajout d'un évènement dans l'agenda du club";
$min = date("Y-m-d", strtotime("+ 6 day"));
$date = $min;
$max = date("Y-m-d", strtotime("+ 1 year"));
require RACINE . '/include/interface.php';

// chargement des composants spécifiques
require RACINE . '/include/ckeditor.php';


