"use strict"

window.onload = () => {
    for (const element of data) {
        let numero = element.numero
        let id = element.id
        let tr = lesLignes.insertRow();
        tr.id = numero;
        tr.style.verticalAlign = 'middle';
        // Colonne permettant de demander la suppression ou la modification de la course
        let td = tr.insertCell();

        let i = document.createElement('i');
        i.classList.add('bi', 'bi-x', 'text-danger', 'm-1');
        i.style.cursor = "pointer";
        i.onclick = () => Std.confirmer(() => supprimer(numero));
        td.appendChild(i);

        i = document.createElement('i');
        i.classList.add('bi', 'bi-pencil', 'text-warning', 'm-1');
        i.style.cursor = "pointer";
        i.onclick = () => location.href = "modification.php?numero=" + numero;
        td.appendChild(i);

        // Colonne numero
        tr.insertCell().innerText = element.numero;

        // Colonne date
        tr.insertCell().innerText = element.dateFr;

        // colonne nom
        tr.insertCell().innerText = element.nom;

        // colonne distance
        tr.insertCell().innerText = element.distance;

        // colonne challenge contenant une case à cocher
        td = tr.insertCell();
        td.style.textAlign = 'center';
        let inputChallenge = document.createElement("input");
        inputChallenge.type = "checkbox";
        inputChallenge.classList.add("form-check-input");
        inputChallenge.checked = element.challenge === 1;
        inputChallenge.onchange = function () {
            modifierCase('challenge', this, id);
        };
        td.appendChild(inputChallenge);

        // colonne label
        td = tr.insertCell();
        td.style.textAlign = 'center';
        let inputLabel = document.createElement("input");
        inputLabel.type = "checkbox";
        inputLabel.classList.add("form-check-input");
        inputLabel.checked = element.label === 1;
        inputLabel.onchange = function () {
            modifierCase('label', this, id);
        };
        td.appendChild(inputLabel);

        // colonne annulee
        td = tr.insertCell();
        td.style.textAlign = 'center';
        let inputAnnulee = document.createElement("input");
        inputAnnulee.type = "checkbox";
        inputAnnulee.classList.add("form-check-input");
        inputAnnulee.checked = element.annulee === 1;
        inputAnnulee.onchange = function () {
            modifierCase('annulee', this, id);
        };
        td.appendChild(inputAnnulee);
    }
}


// ---------------------------------------------
// procédure standard concernant la suppression
// ---------------------------------------------

/**
 * Lance la suppression côté serveur
 * @param {int} numero  identifiant du lien à supprimer
 */
function supprimer(numero) {
    msg.innerHTML = "";
    $.ajax({
        url: 'http://formation/api/calendrier/' + numero,
        method: 'DELETE',
        headers: {
            "Authorization": "Bearer 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",
            "Content-Type": "application/json"
        },
        dataType: 'json',
        success: (data) => {
            if (data.message) {
                Std.afficherErreur(data.message)
            } else if (data.success) {
                Std.afficherSucces(data.success)
                // Mise à jour de l'interface
                let ligne = document.getElementById(numero);
                ligne.parentNode.removeChild(ligne);
            } else if (data.error) {
                msg.innerHTML = Std.genererMessage(data.error)
            } else {
                msg.innerHTML = Std.genererMessage("Absence de réponse du serveur, contacter la maintenance")
            }
        },
        error: (reponse) => {
            msg.innerHTML = Std.genererMessage("L'opération a échoué, contacter la maintenance")
            console.error(reponse.responseText)
        }
    })
}

// ---------------------------------------------
// procédure standard concernant la modification d'une colonne
// ---------------------------------------------


/**
 *
 * @param {string} colonne nom de la colonne à modifier
 * @param {object} champ de type case à cocher
 * @param {int} id identifiant du document à modifier
 */
function modifierCase(colonne, champ, id) {
    let valeur = champ.checked ? 1 : 0;
    $.ajax({
        url: 'http://formation/api/calendrier/',
        method: 'PUT',
        headers: {
            "Authorization": "Bearer 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",
            "Content-Type": "application/json"
        },
        data: JSON.stringify({colonne: colonne, valeur: valeur, id: id}),
        dataType: 'json',
        success: (data) => {
            if (data.message) {
                Std.afficherErreur(data.message)
            } else if (data.success) {
                console.log(data.success);
            } else if (data.error) {
                Std.afficherMessage({
                    message: data.error,
                    fermeture: 1,
                    surFermeture: function () {
                        champ.checked = !champ.checked;
                    }
                })
            } else {
                console.log(data);
            }
        },
        error: function (reponse) {
            Std.afficherMessage({
                message: reponse.responseText,
                fermeture: 0,
                surFermeture: function () {
                    champ.checked = !champ.checked;
                }
            })
        }
    })
}


