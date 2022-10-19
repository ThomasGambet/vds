"use strict";

window.onload = init;

let leFichier = null;

/**
 *  Récupération des photos
 *  Mise en place des gestionnaires d'événements pour l'upload
 */
function init() {

    // chargement des catégories pour alimenter la zone de liste
    $.ajax({
        url: 'ajax/getlespartenaires.php',
        dataType: "json",
        error: response => console.error(response.responseText),
        success: remplirListeCategorie
    });


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
    btnModifier.onclick = modifier;
    pied.style.visibility = 'visible';
}

function remplirListeCategorie(data) {
    for (const element of data) {
        idPartenaire.add(new Option(element.nom, element.logo));
    }
    afficher();
}

function afficher(data) {
    nom.value = data.nom;
    logo.value = data.logo;
    actif.value = data.actif

    // sauvegarde des valeurs initiales afin de détecter une modification
    nom.dataset.old = data.nom;
    logo.dataset.old = data.logo;
    actif.dataset.old = data.actif

    // mise à jour au niveau de l'interface : le bouton supprimer
    btnSupprimer.disabled = data.nb > 0;
    nom.focus();
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


/**
 *
 * @param {file} file objet file et nom du partenaire à ajouter dans les partenaires
 */
function modifier(file) {
    messagePhoto.innerHTML = "";
    let monFormulaire = new FormData();
    monFormulaire.append('fichier', leFichier);
    monFormulaire.append('nom', nom.value);
    $.ajax({
        url: 'ajax/modifier.php',
        type: 'POST',
        data: monFormulaire,
        processData: false,
        contentType: false,
        dataType: 'json',
        error: reponse => {
            messagePhoto.innerHTML = reponse.responseText
        },
        success: function () {
            Std.afficherSucces("Logo modifié");
        }
    });
}