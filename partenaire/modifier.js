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
    btnModifier.onclick = modifierP;
    pied.style.visibility = 'visible';
}

// ------------------------------------------------
// fonction de traitement concernant la modification
// ------------------------------------------------

/**
 * Contrôle sur le fichier téléversé
 * @param {file} file objet file à contrôler
 */
function controlerPhoto(file) {
    messagePhoto.innerHTML = "";
    let controle = {taille: 300 * 100, lesExtensions: ["jpg", "png"]};
    if (Std.fichierValide(file, controle)) {
        messagePhoto.innerText = file.name;
        leFichier = file;
    } else
        messagePhoto.innerHTML = controle.reponse;
}