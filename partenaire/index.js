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

                tr.insertCell().innerText = partenaire.nom;
                tr.insertCell().innerText = partenaire.logo;
                tr.insertCell().innerText = partenaire.actif;
            }
            $("#leTableau").trigger('update');

            pied.style.visibility = 'visible';
        }

    });


}
