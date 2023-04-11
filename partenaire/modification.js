"use strict";

window.onload = init;

let leFichier = null;

/**
 *  Récupération des photos
 *  Mise en place des gestionnaires d'événements pour l'upload
 */
function init() {

    // chargement des partenaires pour alimenter la zone de liste
    $.ajax({
        url: 'ajax/getlespartenaires.php',
        dataType: "json",
        error: response => console.error(response.responseText),
        success: remplirListePartenaire
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


    // Traitement déclenché sur le changement de valeur d'un champ de saisi
    for (const input of document.querySelectorAll('input.ctrl')) {
        input.onchange = () => input.nextElementSibling.innerText = input.validationMessage;
    }

    // traitements associés au champ nom
    nom.onkeypress = (e) => {
        if (!/^[A-Za-z0-9 ]$/.test(e.key)) return false;
    };

    // sur le chargement dans la zone de liste idPartenaire
    idPartenaire.onchange = rechercher;

    // Le bouton 'btnModifier'
    btnModifier.onclick = modifier;

    // le bouton 'btnSupprimer'
    btnSupprimer.onclick = () => Std.confirmer(supprimer);
}

function remplirListePartenaire(data) {
    for (const element of data) {
        idPartenaire.add(new Option(element.nom, element.id));
    }
    rechercher();
}


function rechercher() {
    // un message d'erreur précédent peut encore être affiché
    for (const input of document.querySelectorAll('input.ctrl')) {
        input.nextElementSibling.innerText = '';
    }
    // lancement de la recherche
    $.ajax({
        url: 'ajax/getbyid.php',
        type: 'POST',
        data: {id: idPartenaire.value},
        dataType: "json",
        success: afficher,
        error: (reponse) => Std.afficherErreur(reponse.responseText)
    })
}


function afficher(data) {
    messagePhoto.innerText = data.logo;
    cible.innerHTML = "";
    nom.value = data.nom;
    let logo = document.createElement('img');
    logo.src = '../data/logopartenaire/' + data.logo;
    logo.style.height = "100px";
    cible.appendChild(logo);


    // sauvegarde des valeurs initiales afin de détecter une modification
    nom.dataset.old = data.nom;
    photo.dataset.old = data.logo;

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
    cible.innerHTML = "";
    messagePhoto.innerHTML = "";
    let controle = {taille: 30 * 1024, lesExtensions: ["jpg", "png"]};
    if (Std.fichierValide(file, controle)) {
        messagePhoto.innerText = file.name;
        leFichier = file;
        let logo = document.createElement('img');
        logo.src = URL.createObjectURL(file)
        logo.style.height = "100px";
        cible.appendChild(logo);
    } else
        cible.innerHTML = controle.reponse;
}

function supprimer() {
    $.ajax({
        url: 'ajax/supprimer.php',
        type: 'POST',
        data: {id: idPartenaire.value},
        dataType: "json",
        success: function () {
            Std.afficherSucces("Suppression réalisée");
            // mettre à jour la zone de liste en supprimant l'option sélectionnée et relancer la recherche
            let index = idPartenaire.selectedIndex;
            idPartenaire.removeChild(idPartenaire[idPartenaire.selectedIndex]);
            if (idPartenaire.length === 0) {
                location.href = "..";
            }
            if (index === idPartenaire.length) {
                idPartenaire.selectedIndex = index - 1;
            } else {
                idPartenaire.selectedIndex = index;
            }
            rechercher();
        },
        error: (reponse) => Std.afficherErreur(reponse.responseText)
    })
}

function modifier() {
    let erreur = false
    for (const input of document.querySelectorAll('input.ctrl')) {
        input.nextElementSibling.innerText = input.validationMessage;
        if (!input.checkValidity()) erreur = true
    }
    if (erreur) return;
    // demande de modification
    // Transmission des champs modifiés
    let monFormulaire = new FormData();
    monFormulaire.append('id', idPartenaire.value);
    if (nom.value !== nom.dataset.old) monFormulaire.append('nom', nom.value);
    if (photo.files[0].name !== photo.dataset.old) monFormulaire.append('logo', photo.files[0].name);


    // au moins un champ doit avoir été modifié donc monFormulaire doit posséder au moins deux paramètres
    // il n'y a pas de méthode pour cela, il faut parcourir les clés et les compter
    // if( monFormulaire.values()[Symbol.iterator].length < 2) {
    let nb = 0;
    for (const key of monFormulaire.keys()) nb++
    //  Array.from(monFormulaire.entries()).length
    if (nb < 2) {
        Std.afficherErreur("Aucune modification constatée");
        return;
    }


    // lancement de la demande de modification
    $.ajax({
        url: 'ajax/modifier.php',
        type: 'POST',
        data: monFormulaire,
        processData: false,
        contentType: false,
        dataType: "json",
        success: () => {
            Std.afficherSucces("Modification enregistrée");
            nom.dataset.old = nom.value;
            photo.dataset.old = photo.value;
        },
        error: (reponse) => Std.afficherErreur(reponse.responseText)
    })
}