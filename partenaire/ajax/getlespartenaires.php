<?php
/**
 * Fournit la liste des partenaires
 * Appel : partenaire/index.js
 * Résultat : liste des membres au format json
 */

require '../../include/initialisation.php';
require '../../include/controleacces.php';

// récupération des informations sur les membres

echo json_encode(Partenaire::getLesPartenaires());


