<?php
// Vérification des paramètres attendus
if (!isset($_POST['id'])) {
    echo "L'id du partenaire n'est pas transmis";
    exit;
}

// Récupération et contrôle des paramètres
$id = trim($_POST['id']);

// Contrôle des données
require '../../class/class.database.php';
$db = Database::getInstance();
if (empty($id)) {
    echo "L'id du partenaire doit être renseigné.";
    exit;
} else {
    //  l'id du partenaire doit exister
    $sql = <<<EOD
        SELECT id, nom, logo
        FROM partenaire
        where id = :id;
EOD;
    $curseur = $db->prepare($sql);
    $curseur->bindParam('id', $id);
    $curseur->execute();
    $ligne = $curseur->fetch(PDO::FETCH_ASSOC);
    $curseur->closeCursor();
    if (!$ligne) {
        echo $id;
        exit;
    }
}


// envoi des informations sur le partenaire
echo json_encode($ligne);
