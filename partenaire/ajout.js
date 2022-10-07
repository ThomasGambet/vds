"use strict";

window.onload = init;

let leFichier = null;

/**
 *  Récupération des photos
 *  Mise en place des gestionnaires d'événements pour l'upload
 */
function init() {

    // paramétrage de la zone d'upload
    new bootstrap.Popover(cible);
    cible.onclick = () => photo.click();
    cible.ondragover = (e) => e.preventDefault();
    cible.ondrop = function (e) {
        e.preventDefault();
        controlerPhoto(e.dataTransfer.files[0]);
    }
    photo.onchange = () => {
        if (photo.files.length > 0) controlerPhoto(photo.files[0]);
    };
    btnAjouter.onclick = ajouter;
    pied.style.visibility = 'visible';
}

// ------------------------------------------------
// fonction de traitement concernant l'ajout
// ------------------------------------------------

/**
 * Contrôle sur le fichier téléversé
 * @param {file} file objet file à contrôler
 */
function controlerPhoto(file) {
    messagePhoto.innerHTML = "";
    let controle = {taille: 300 * 100, lesExtensions: ["jpg", "png"]};
    if (Std.fichierValide(file, controle)) {
        messagePhoto.innerHTML = file.name;
        leFichier = file;
    } else
        messagePhoto.innerHTML = controle.reponse;
}


/**
 *
 * @param {file} file objet file à ajouter dans la photothèque
 */
function ajouter(file) {
    messagePhoto.innerHTML = "";
    let monFormulaire = new FormData();
    monFormulaire.append('fichier', leFichier);
    $.ajax({
        url: 'ajax/ajouter.php',
        type: 'POST',
        data: monFormulaire,
        processData: false,
        contentType: false,
        dataType: 'json',
        error: reponse => {
            messagePhoto.innerHTML = reponse.responseText
        },
        success: function () {
            Std.afficherSucces("Photo ajoutée");
            // mise à jour de l'interface : on recharge les données
            getLesPhotos();

        }
    });
}



