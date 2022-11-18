<?php
/**
 *  Modifier un logo dans les partenaires
 * Appel : partenaire/modification.js
 * Résultat : 1 ou message d'erreur
 */


// Vérification des paramètres attendus
if (!isset($_POST['id'])) {
    echo "L'id du partenaire n'est pas transmis";
    exit;
}

// récupération des paramètres
$id = strtoupper(trim($_POST['id']));

// il faut au moins transmettre un des champs suivant : nom, logo
require '../../class/class.controle.php';
$nb = 0;

if (isset($_POST['nom'])) {
    $nom = ucfirst(Controle::supprimerEspace($_POST['nom']));
    $nb++;
}

if (isset($_POST['logo'])) {
    $logo = trim($_POST['logo']);
    $nb++;
}

if ($nb === 0) {
    echo "Aucune modification demandée";
    exit;
}


// Contrôle des données
require '../../class/class.database.php';
$db = Database::getInstance();
$erreur = false;
// id rappel : il n'est pas modifiable
if (empty($id)) {
    echo "\nL'id du partenaire doit être renseigné.";
    $erreur = true;
} elseif (!preg_match("/^[0-9]{1}$/", $id)) {
    echo "\nL'id du partenaire n'est pas conforme.";
    $erreur = true;
} else {
    //  l'id du partenaire doit exister
    $sql = <<<EOD
			SELECT 1
			FROM partenaire
			where id = :id;
	EOD;
    $curseur = $db->prepare($sql);
    $curseur->bindParam('id', $id);
    $curseur->execute();
    $ligne = $curseur->fetch(PDO::FETCH_ASSOC);
    $curseur->closeCursor();
    if (!$ligne) {
        echo "Cette id du partenaire n'existe pas";
        $erreur = true;
    }
}

// contrôle du nom si transmis
if (isset($nom)) {
    if (empty($nom)) {
        echo "\nLe nom doit être renseigné.";
        $erreur = true;
    } elseif (!preg_match("/^[A-Za-z][A-Za-z0-9 ]{4,19}$/", $nom)) {
        echo "\nLe nom n'est pas conforme : 20 caractères max. : lettres non accentuées et chiffres et espaces espaces acceptés";
        $erreur = true;
    } else {
        // ce nom ne doit pas correspondre au nom d'un autre partenaire : attention
        $sql = <<<EOD
	    Select 1 from partenaire
        where nom = :nom
        and id != :id;

EOD;
        $curseur = $db->prepare($sql);
        $curseur->bindParam('nom', $nom);
        $curseur->bindParam('id', $id);
        $curseur->execute();
        $ligne = $curseur->fetch(PDO::FETCH_ASSOC);
        $curseur->closeCursor();
        if ($ligne) {
            echo "Ce nom correspond au nom d'un autre partenaire";
            $erreur = true;
        }
    }
}


if ($erreur) exit;


// enregistrement de la modification

// génération du contenu de la clause set
$set = "set ";
if (isset($nom)) $set .= " nom = :nom,";
if (isset($logo)) $set .= " logo = :logo,";

// il faut retirer la dernière virgule et ajouter un espace pour ne pas coller la clause where
$set = substr($set, 0, -1) . " ";
// requête de mise à jour
$sql = <<<EOD
    update partenaire
    $set 
    where id = :id;
EOD;


// passage des autres paramètres s'ils sont renseignés
$curseur = $db->prepare($sql);
$curseur->bindParam('id', $id);
if (isset($nom)) $curseur->bindParam('nom', $nom);
if (isset($logo)) $curseur->bindParam('logo', $logo);

try {
    $curseur->execute();
    echo 1;
} catch (Exception $e) {
    echo substr($e->getMessage(), strrpos($e->getMessage(), '#') + 1);
}
