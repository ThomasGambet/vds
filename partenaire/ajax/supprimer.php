<?php
// Vérification des paramètres attendus
if (!isset($_POST['id'])) {
    echo "L'id du partenaire n'est pas transmis";
    exit;
}

// récupération des paramètres
$id = trim(strtoupper($_POST['id']));


// contrôle des données

// contrôle de l'id du partenaire : renseigné, existant et supprimable
require '../../class/class.database.php';
$db = Database::getInstance();
if (empty($id)) {
    echo "L'id du partenaire doit être renseigné.";
    exit;
} else {
    //  l'id du partenaire doit exister
    $sql = <<<EOD
        SELECT nom, logo
        FROM partenaire
        where id = :id;
EOD;
    $curseur = $db->prepare($sql);
    $curseur->bindParam('id', $id);
    $curseur->execute();
    $ligne = $curseur->fetch(PDO::FETCH_ASSOC);
    $curseur->closeCursor();
    if (!$ligne) {
        echo "L'id du partenaire n'existe pas";
        exit;
    }
}


// Réalisation de la requête de suppression
$sql = <<<EOD
	   DELETE FROM partenaire
	   WHERE id = :id;
EOD;
$curseur = $db->prepare($sql);
$curseur->bindParam('id', $id);
try {
    $curseur->execute();
    echo 1;
} catch (Exception $e) {
    echo substr($e->getMessage(), strrpos($e->getMessage(), '#') + 1);
}