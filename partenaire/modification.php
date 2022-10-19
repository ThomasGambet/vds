<?php
/**
 * Interface de modification d'un partenaire
 */

require '../include/initialisation.php';
require '../include/controleacces.php';
$titreFonction = "Modification partenaire";
require RACINE . '/include/head.php';
?>

    <script src="modification.js"></script>


    <div class="row">
        <div class="col-12 col-sm-10 col-md-6 ">
            <div class="input-group mb-3 ">
                <label class="input-group-text" for="idPartenaire">Partenaire</label>
                <select class="form-select " id="idPartenaire"></select>
                <button id="btnSupprimer" class="btn btn-danger ">Supprimer</button>
            </div>
        </div>
    </div>
    <div class="border p-3">
        <div id="msg" class="m-3"></div>
        <div class="row">
            <div class="col-md-6 col-12">
                <label for="nom" class="col-form-label">Nom</label>
                <input id="nom"
                       type="text"
                       class="form-control ctrl"
                       required
                       maxlength='30'
                       pattern="^[A-Za-z]([A-Za-z ]*[A-Za-z])*$"
                       autocomplete="off">
                <div class='messageErreur'></div>
            </div>
            <input type="file" id="photo" accept=".jpg, .png, .gif" style='display:none'>
            <label class="col-form-label">Logo</label>
            <div id="cible" class="upload col-md-6 col-12">
                <i class="bi bi-cloud-upload m-1" style="font-size:2rem"></i>
                Déposer le logo (png ou jpg) dans ce cadre (taille limitée à 30 Ko)
            </div>
            <span id="messagePhoto" class="messageErreur"></span>
            <div id='lesPhotos' class="text-center mt-3"></div>
        </div>
        <div class="text-center">
            <button id='btnModifier' class="btn btn btn-danger">Modifier</button>
        </div>
    </div>
<?php require RACINE . '/include/pied.php'; ?>