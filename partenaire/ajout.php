<?php
/**
 * Interface d'ajout d'un partenaire
 */

require '../include/initialisation.php';
require '../include/controleacces.php';
$titreFonction = "Nouveau partenaire";
require RACINE . '/include/head.php';
?>

<script src="ajout.js"></script>

<div class="border p-3 mt-3">
    <div id="msg" class="m-3"></div>
    <div class="row">
        <div class="col-md-6 col-12">
            <label for="nom" class="col-form-label">Nom </label>
            <input id="nom"
                   type="text"
                   class="form-control ctrl  "
                   required
                   maxlength='30'
                   pattern="^[A-Za-z]([A-Za-z ]*[A-Za-z])*$"
                   autocomplete="off">
            <div class='messageErreur'></div>
        </div>
        <input type="file" id="photo" accept=".jpg, .png, .gif" style='display:none'>
        <label class="col-form-label">Logo à ajouter</label>
        <div id="cible" class="upload">
            <i class="bi bi-cloud-upload m-1" style="font-size:2rem"></i>
            Déposer le logo (png ou jpg) dans ce cadre (taille limitée à 30 Ko)
        </div>
        <span id="messagePhoto" class="messageErreur"></span>
        <div id='lesPhotos' class="text-center mt-3"></div>
    </div>
    <div class="text-center">
        <button id='btnAjouter' class="btn btn btn-danger">Ajouter</button>
    </div>
</div>
<?php require RACINE . '/include/pied.php'; ?>


