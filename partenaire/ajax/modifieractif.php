<?php

require '../../include/initialisation.php';
require '../../include/controleacces.php';

// Récupération et contrôle des paramètres
$id = trim($_POST['id']);

$reponse = "";
Partenaire::modifierActif($id, $reponse);
echo 1;