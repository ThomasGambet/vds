"use strict";

/**
 * Proposer les différentes actions possibles sur les partenaires :
 *     l'ajout d'un partenaire
 */

window.onload = init

/**
 * initialisation des gestionnaires d'événement
 */
function init() {

    $.ajax({
        url: 'ajax/getlespartenaires.php',
        dataType: 'json',
        error: reponse => {
            msg.innerHTML = Std.genererMessage(reponse.responseText)
        },
        success: function (data) {
            for (const partenaire of data) {
                let tr = lesLignes.insertRow();
                tr.insertCell().inputMode = btnSupprimer.onclick = () => Std.confirmer(supprimer);
                tr.insertCell().innerText = partenaire.nom;
                let img = document.createElement('img');
                img.src = '../data/logopartenaire/' + partenaire.logo;
                img.style.height = "100px";
                img.alt = "";
                tr.appendChild(img);
                tr.insertCell().inputMode = partenaire.actif;
            }
            $("#leTableau").tablesorter();

            pied.style.visibility = 'visible';
        }

    });

    btnSupprimer.onclick = () => Std.confirmer(supprimer);

}

function supprimer() {
    $.ajax({
        url: 'ajax/supprimer.php',
        type: 'POST',
        data: {id: idPartenaire.value},
        dataType: "json",
        success: function () {
            Std.afficherSucces("Suppression réalisée");
            rechercher();
        },
        error: (reponse) => Std.afficherErreur(reponse.responseText)
    })
}

function modifieractif() {
    $.ajax({
        url: 'ajax/modifieractif.php',
        type: 'POST',
        data: {id: idPartenaire.value},
        dataType: "json",
        success: function () {
            Std.afficherSucces("Suppression réalisée");
            rechercher();
        },
        error: (reponse) => Std.afficherErreur(reponse.responseText)
    })
}