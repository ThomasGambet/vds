<?php
/**
 * Affichage de l'ensemble des opérations de gestion concernant les partenaires
 */

require '../include/initialisation.php';
require '../include/controleacces.php';
$titreFonction = "Gestion des partenaires";
require RACINE . '/include/head.php';

?>
<script src="index.js"></script>
<div id="msg" class="m-3"></div>
<div class='row'>
    <div class="col-6 text-center">
        <div class="card">
            <div class="card-header">
                <a href="ajout.php" class="btn btn btn-danger">Ajouter un nouveau partenaire</a>
            </div>
            <div class="card-body">
                2 informations uniquement à fournir : nom et logo.
            </div>
        </div>
    </div>
    <div class="col-6 text-center ">
        <div class="card">
            <div class="card-header">
                <a href="modification.php" class="btn btn btn-danger">Modifier les partenaires</a>
            </div>
            <div class="card-body">
                Permet de modifier les partenaires.
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/css/theme.bootstrap_4.min.css"/>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.min.js"></script>
<div id="msg" class="m-3"></div>
<div class='col-6 table-responsive mt-1'>
    <table id='leTableau' class='table table-sm table-borderless tablesorter-bootstrap'
           style="font-size: 1rem">
        <thead>
        <tr>
            <th style=''>Nom</th>
            <th style=''>Logo</th>
            <th style=''>visibilité</th>
        </tr>
        </thead>
        <tbody id="lesLignes"></tbody>
    </table>
</div>

<?php require RACINE . '/include/pied.php'; ?>



