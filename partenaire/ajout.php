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
        <input type="file" id="fichier" accept=".jpg, .png" style='display:none'>
        <div class="col-md-6 col-12 text-center">
            <div id="cible" class="upload"
                 data-bs-trigger="hover"
                 data-bs-placement="bottom"
                 data-bs-html="true"
                 data-bs-title="<b>Règles à respecter<b>"
                 data-bs-content="Extensions acceptées : jpg et png<br>Taille limitée à 30 Ko<br>Dimension maximale : 150 * 150">
                <i class="bi bi-cloud-upload" style="font-size: 4rem; color: #8b8a8a;"></i>
                <div>Cliquez ou déposer la photo ici</div>
            </div>
            <div class="form-group">
                <img src="<?php echo is_file('data/img') ?>" alt="" id="cimg">
            </div>
            <div id="messageCible" class="messageErreur"></div>
        </div>
    </div>
    <div class="text-center">
        <button id='btnAjouter' class="btn btn btn-danger">Ajouter</button>
    </div>
</div>
<?php require RACINE . '/include/pied.php'; ?>


